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

        $email = $request->input('email');
        $id = User::where('email', $email)->value('id');
        $request ->session()->put('id',  $id);
        $request ->session()->put('email',  $email);

        //dd($request->session()->get('id'));
        dd($request->session()->get('email'));

        // if ( !auth()-> attempt ($request->only('email', 'password')))
        // {
        //     return back()->with('error', 'Invalid email or password');
        // }
        // esle{
        //     return redirect()->route('dashboard');
        // }




}
}
