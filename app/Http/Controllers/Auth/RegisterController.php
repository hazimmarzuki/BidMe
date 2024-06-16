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

        $data = $request -> validate ([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|unique:users',
            'address' => 'required',
            'password' => 'required|confirmed'

           ]); //

        $data['password'] = Hash::make($data['password']);

           User::create ($data);

           return redirect()->route('login');
    }
}
