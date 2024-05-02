<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function index(){
        $seller_id = Auth::id();
        $items = Item::where('seller_id', $seller_id)
        ->with('bids')
        ->withCount('bids')
        ->orderBy('countdown_date', 'asc')->paginate(6);
        return view('profile', compact('items'));

    }

    public function editprofile(){

        return view('editprofile');
    }

    public function updateprofile(Request $request, $id){

        Auth::user()->name = $request->name;
        Auth::user()->email = $request->email;
        Auth::user()->phone = $request->phone;

        Auth::user()->save();

        return back()->with('success', 'Profile updated successfully');


    }
}
