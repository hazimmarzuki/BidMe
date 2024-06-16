<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bid;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
public function bidview($id)
    {
        $item = Item::withCount('bids')
        ->findOrFail($id);
        return view('bid-view', compact('item'));
    }
public function bid(Request $request, $id) // update item price and create/ovewrite bid
{
    $item = Item::findOrFail($id);
    $currentPrice = $item->price;


    // Determine the bid increment based on the current price
    $bidIncrement = 0;
    if ($currentPrice >= 0 && $currentPrice < 25) {
        $bidIncrement = 0.5;
    } elseif ($currentPrice >= 25 && $currentPrice < 100) {
        $bidIncrement = 1;
    } elseif ($currentPrice >= 100 && $currentPrice < 250) {
        $bidIncrement = 2.5;
    } elseif ($currentPrice >= 250 && $currentPrice < 500) {
        $bidIncrement = 5;
    } elseif ($currentPrice >= 500 && $currentPrice < 1000) {
        $bidIncrement = 10;
    } elseif ($currentPrice >= 1000 && $currentPrice < 2500) {
        $bidIncrement = 25;
    } elseif ($currentPrice >= 2500 && $currentPrice < 5000) {
        $bidIncrement = 50;
    } elseif ($currentPrice >= 5000) {
        $bidIncrement = 100;
    }

    if ($request->bid >= $currentPrice + $bidIncrement) {
        $validatedData = $request->validate([
            'bid' => 'required|numeric|min:' . ($currentPrice + $bidIncrement) ,
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

        return redirect()->route('show-items')->with('success', 'bid placed successfully!');
    } else {
        return back()->with('error', 'Oops! Your bid must be at least the minimum price stated. Try again!');
    }
}

public function viewbuyers( $id )
{
    $buyers = Bid::where('item_id', $id)
    ->with('buyer')
    ->with ('item')
    ->orderBy('bid_amount', 'desc')->get();

    return view('view-buyers', compact('buyers'));

}

public function showbids()
{
    $bids = Bid::where('buyer_id', Auth::id())
    ->with('item')
    ->with('payment')
    ->orderBy('bid_time', 'desc')
    ->get();

    return view('show-bids', compact('bids'));


}


}
