<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function indexSquare(){
        $seller_id = Auth::id();
        $items = Item::where('seller_id', $seller_id)
        ->with('bids')
        ->withCount('bids')
        ->orderBy('countdown_date', 'desc')->paginate(6);
        return view('profilesquare', compact('items'));

    }

    public function indexList(){
        $seller_id = Auth::id();
        $items = Item::where('seller_id', $seller_id)
        ->with('bids')
        ->withCount('bids')
        ->orderBy('countdown_date', 'desc')
        ->get();
        return view('profilelist', compact('items'));

    }


    public function editprofile(){

        return view('editprofile');
    }

    public function updateprofile(Request $request, $id){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phone' => 'required|unique:users,phone,'.$id,
            'address' => 'required',
        ]);

        Auth::user()->name = $request->name;
        Auth::user()->email = $request->email;
        Auth::user()->phone = $request->phone;
        Auth::user()->address = $request->address;


        Auth::user()->save();

        return back()->with('success', 'Profile updated successfully');


    }
}
