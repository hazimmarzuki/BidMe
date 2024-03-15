<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        return view('profile');
    }

    public function editprofile(){
        $user = Auth::user();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->save();
        // return redirect()->route('profile');
        return view('editprofile');
    }

    public function updateprofile(Request $request, $id){

        Auth::user()->name = $request->name;
        Auth::user()->email = $request->email;

        Auth::user()->save();

        return back()->with('success', 'Profile updated successfully');
       // dd($request);

    }
}
