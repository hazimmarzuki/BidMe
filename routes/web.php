<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PaymentController;
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

// Route::get('/', function () {
//     return view('showitems');
// }) ;



//Authentication

//go to register page//
Route::get('/register', [RegisterController::class, 'index' ]) -> name ('register');

//send data from register form to database//
Route::post('/register', [RegisterController::class, 'store' ]) -> name ('register-store');

Route::get('/login', [LoginController::class, 'index' ]) -> name ('login');

Route::post('/login', [LoginController::class, 'store' ]) -> name ('login-store');

Route::post('/logout', [LogoutController::class, 'logout' ]) -> name ('logout');


Route::get('/dashboard', [DashboardController::class, 'index' ])
-> name ('dashboard')->middleware ('auth');

//profile
Route::get('/profile-square', [ProfileController::class, 'index' ]) // show all items of the user
-> name ('profile-square')->middleware ('auth');

Route::get('/profile/edit', [ProfileController::class, 'editprofile' ])
-> name ('edit-profile')->middleware ('auth');

Route::post('/profile/{id}', [ProfileController::class, 'updateprofile' ])
-> name ('update-profile')->middleware ('auth');

//item
Route::get('/', [ItemController::class, 'index' ])
-> name ('show-items');

Route::get('/item/create', [ItemController::class, 'create' ])
-> name ('create-item')->middleware ('auth');

Route::post('/item/store', [ItemController::class, 'store'])
-> name ('store-item')->middleware ('auth');

Route::get ('/item/{id}/edit', [ItemController::class, 'edit'])
-> name ('edit-item') ->middleware ('auth');

Route::post ('/item/{id}', [ItemController::class, 'update'])
-> name ('update-item')->middleware ('auth');

Route::delete ('/item/{id}', [ItemController::class, 'destroy'])
-> name ('delete-item')->middleware ('auth');

Route::get ('/item/{id}/view', [ItemController::class, 'itemview'])
-> name ('item-view') ->middleware ('auth');

Route::get('/search-item', [ItemController::class, 'search'])
->name('search-item') ->middleware('auth');

//bid

Route::get ('/bid/{id}/view', [BidController::class, 'bidview'])
-> name ('bid-view') ->middleware ('auth');

Route::post ('/bid/{id}', [BidController::class, 'bid'])
-> name ('bid-item')->middleware ('auth');

Route::get ('/bid/buyers/{id}', [BidController::class, 'viewbuyers'])
-> name ('view-bidders')->middleware ('auth');

Route::get ('/bid/showbids/', [BidController::class, 'showbids'])
-> name ('show-bids')->middleware ('auth');

//payment

Route::get ('/payment/{id}', [PaymentController::class, 'showPaymentForm'])
->name ('payment')->middleware ('auth');

Route::post ('/create-payment/{id}', [PaymentController::class, 'createPayment'])
->name ('create-payment');

Route::get ('/payment-status', [PaymentController::class, 'paymentStatus'])
->name ('payment-status');

Route::get('/payment-callback', [PaymentController::class, 'callback'])
->name('payment-callback');

//history

Route::get ('/purchase-history', [HistoryController::class, 'purchasehistory'])
->name ('purchase-history')->middleware('auth');

Route::get ('/sales-history', [HistoryController::class, 'saleshistory'])
->name ('sales-history')->middleware('auth');

