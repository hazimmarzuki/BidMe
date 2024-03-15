<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
}) ;



//Authentication

//go to register page//
Route::get('/register', [RegisterController::class, 'index' ]) -> name ('register');

//send data from register form to database//
Route::post('/register', [RegisterController::class, 'store' ]) -> name ('register-store');

Route::get('/login', [LoginController::class, 'index' ]) -> name ('login');

Route::post('/login', [LoginController::class, 'store' ]) -> name ('login-store');

Route::post('/logout', [LogoutController::class, 'store' ]) -> name ('logout');


Route::get('/dashboard', [DashboardController::class, 'index' ])
-> name ('dashboard')
->middleware ('auth');

Route::get('/profile', [ProfileController::class, 'index' ])
-> name ('profile')
->middleware ('auth');

Route::get('/profile/edit', [ProfileController::class, 'editprofile' ])
-> name ('edit-profile')
->middleware ('auth');

Route::post('/profile/{id}', [ProfileController::class, 'updateprofile' ])
-> name ('update-profile')
->middleware ('auth');


