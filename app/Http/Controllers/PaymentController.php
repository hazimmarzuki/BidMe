<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;
use Billplz\Client;


class PaymentController extends Controller
{
    //
    public function showPaymentForm($id)
    {
        $bid = Bid::where('id', $id)
        ->with('buyer')
        ->with('item')->firstOrFail();
        return view('payment', compact('bid'));
    }

    public function paymentProcess(Request $request, $id){

        $billplz = Client::make(config('billplz.billplz_key'), config('billplz.billplz_signature'));

        if(config('billplz.billplz_sandbox')){

            $billplz->useSandbox();
        }

        $bill = $billplz->bill();

        $bill = $bill->create(
            config('billplz.billplz_collection_id'),
            $request->buyer_name,
            $request->item_title,
            \Duit\MYR::given($request->amount),
            url('/'),
            'Click testing',
            ['redirect_url' => url('/redirect')]
        );

        return redirect($bill->toArray()['url']);

    }




}
