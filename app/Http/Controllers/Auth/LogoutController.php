<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('show-items-square');
        }

        return redirect()->route('show-items-square');
    }
}
