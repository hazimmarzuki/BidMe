<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){

        $request -> validate ([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ( !auth()-> attempt ($request->only('email', 'password')))
        {
            return back()->with('error', 'Invalid email or password');
        }

            return redirect()->route('show-items-square');

}
}
