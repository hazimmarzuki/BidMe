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

        $email= User::find($request->input('email'));
        $request ->session()->put('id', User::select['id']->where('email', $email));

        dd($request->session()->get('id'));
        // if ( !auth()-> attempt ($request->only('email', 'password')))
        // {
        //     return back()->with('error', 'Invalid email or password');
        // }
        // esle{
        //     return redirect()->route('dashboard');
        // }

// hi git


}
}
