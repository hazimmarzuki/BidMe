<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;


class PaymentController extends Controller
{
    public function showPaymentForm($id)
    {
        $bid = Bid::where('id', $id)
        ->with('buyer')
        ->with('item')->firstOrFail();
        return view('payment', compact('bid'));
    }

    public function createpayment(Request $request, $id)
    {
        $bid = Bid::where('id', $id)
        ->with('buyer')
        ->with('item')->firstOrFail();
        $option = array(
            'userSecretKey'=> config('toyyibpay.key'),
            'categoryCode'=> config('toyyibpay.category'),
            'billName'=> substr($bid->item->title, 0, 30),
            'billDescription'=>'Bid Me',
            'billPriceSetting'=>1, //0 for fixed amount ,  for user key in data
            'billPayorInfo'=>1,
            'billAmount'=>$bid->bid_amount*100,
            'billReturnUrl'=>route('payment-status'),
            'billCallbackUrl'=>route('payment-callback'),
            'billExternalReferenceNo' => $bid->id, //order-id
            'billTo'=>$bid->buyer->name,
            'billEmail'=>$bid->buyer->email,
            'billPhone'=> '0126777439',
            'billSplitPayment'=>0,
            'billSplitPaymentArgs'=>'',
            'billPaymentChannel'=>0,
            'billChargeToCustomer'=>0
          );

          $url = 'https://dev.toyyibpay.com/index.php/api/createBill';
          $response = Http::asForm()->post($url, $option);
          if ($response->successful()) {
            $responseData = $response->json();

            if (isset($responseData[0]['BillCode'])) {
                $billcode = $response[0]['BillCode'];
                 session(['amount' => $bid->bid_amount]);
                return redirect('https://dev.toyyibpay.com/' . $billcode);
            } else {
                // Handle case where BillCode is not present in the response
                dd($responseData);

                // return response()->json(['error' => 'BillCode not found in response'], 400);
            }
        } else {
            // Handle unsuccessful API response
            return response()->json(['error' => 'API request failed'], 500);
        }
    }

    public function paymentStatus()
    {
        $request = request(); // get the current request instance
        $amount = session('amount');

        // Determine the payment status
        $status = $request->input('status_id') == 1 ? 'success' : ($request->input('status_id') == 3 ? 'fail' : 'unknown');

        // Validate the request data
        $validatedData = [
            'amount' => $amount,
            'bid_id' => $request->input('order_id'),
            'status' => $status,
        ];

        // Update the existing record or create a new one
        Payment::updateOrCreate(
            ['bid_id' => $request->input('order_id')], // Criteria to find the existing record
            $validatedData // Data to update or create
        );

        return redirect()->route('show-bids')->with('success', 'Item has been paid!');
    }


    public function callback()
    {
        $request = request(); // get the current request instance

        $validatedData = [
            'amount' => $request->input('amount'),
            'bid_id' => $request->input('order_id'),
        ];

        Payment::create($validatedData);

        return redirect()->route('show-bids')->with('success', 'item has been paid!');

    }


}
