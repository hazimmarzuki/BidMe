<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    //

    public function purchasehistory () {

        $history =  Bid::where('buyer_id', Auth::id())
        ->with('item')
        ->with('seller')
        ->with('payment')
        ->orderBy('bid_time', 'desc')
        ->get();

    $filteredHistory = collect($history)->filter(function ($bid) {
        return $bid->payment && $bid->payment->bid_id == $bid->id && $bid->payment->status == 'success';
    });

    return view('purchase-history', compact('filteredHistory'));
    }

    public function saleshistory () {
        $history =  Bid::where('seller_id', Auth::id())
        ->with('item')
        ->with('buyer')
        ->with('payment')
        ->orderBy('bid_time', 'desc')
        ->get();

    $filteredHistory = collect($history)->filter(function ($bid) {
        return $bid->payment && $bid->payment->bid_id == $bid->id;
    });

    return view('sales-history', compact('filteredHistory'));

    }
}
