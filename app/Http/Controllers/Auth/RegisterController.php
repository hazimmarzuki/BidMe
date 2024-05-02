<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){

      // dd($request);
        $data = $request -> validate ([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|tel',
            'password' => 'required|min:6|confirmed'

           ]); //

        $data['password'] = Hash::make($data['password']);

           User::create ($data);

           return redirect()->route('login');
    }
}
