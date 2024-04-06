<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bid;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    //
//     public function bid(Request $request, $id)
// {
//     $item = Item::findOrFail($id);
//     if($request->bid > $item->price) {
//     $validatedData = $request->validate([
//         'bid' => 'required|numeric|min:0',
//     ]);
//     $item->price = $request->bid;
//     $item->save();

//     $currentDateTime = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');


//     $data['item_id'] = $item->id;
//     $data['bid_amount'] = $item->price;
//     $data['seller_id'] = $item->seller_id;
//     $data['buyer_id'] = Auth::id();
//     $data['bid_time'] = $currentDateTime;
//     Bid::create($data);


//     return redirect()->route('bid-view', $id)->with('success', 'bid placed successfully!');

// }
// else{
//     return back()->with('error', 'you need to bid more than the current price');
// }
// }
public function bid(Request $request, $id)
{
    $item = Item::findOrFail($id);
    if ($request->bid > $item->price) {
        $validatedData = $request->validate([
            'bid' => 'required|numeric|min:0',
        ]);

        $currentDateTime = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $bid = Bid::firstOrCreate(
            ['item_id' => $item->id, 'buyer_id' => Auth::id()],
            [
                'bid_amount' => $request->bid,
                'seller_id' => $item->seller_id,
                'bid_time' => $currentDateTime
            ]
        );

        if (!$bid->wasRecentlyCreated) {
            $bid->update([
                'bid_amount' => $request->bid,
                'bid_time' => $currentDateTime
            ]);
        }

        $item->price = $request->bid;
        $item->save();

        return redirect()->route('bid-view', $id)->with('success', 'bid placed successfully!');
    } else {
        return back()->with('error', 'you need to bid more than the current price');
    }
}

}
