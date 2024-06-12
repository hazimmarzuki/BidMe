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
        return view('profilesquare', compact('items'));

    }

    public function editprofile(){

        return view('editprofile');
    }

    public function updateprofile(Request $request, $id){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phone' => 'required|unique:users,phone,'.$id,
        ]);

        Auth::user()->name = $request->name;
        Auth::user()->email = $request->email;
        Auth::user()->phone = $request->phone;

        Auth::user()->save();

        return back()->with('success', 'Profile updated successfully');


    }
}
