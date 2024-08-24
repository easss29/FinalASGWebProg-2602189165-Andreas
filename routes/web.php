<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\AuthenticationController;


// Route::get('/', function () {
//     return view('home');
// });


Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

Route::post('/logout', [AuthenticationController::class, 'logout']);

Route::get('/pay', function () {
    $user = Auth::user();
    $price = $user->register_price;
    return view('pay', compact('price'));
})->name('pay');
Route::post('/updatePaid', [AuthenticationController::class, 'update_paid'])->name('updatePaid');
Route::get('/overpayment', [AuthenticationController::class, 'handleOverpayment'])->name('handle.overpayment');
Route::post('/overpayment', [AuthenticationController::class, 'processOverpayment'])->name('process.overpayment');

Route::middleware(['auth', 'paid'])->group(function () {
    // Route::get('/', function () {
    //     return view('home');
    // })->name('home');

    Route::resource('user', UserController::class);
    Route::resource('friend-request', FriendRequestController::class);
    Route::resource('friend', FriendController::class);
    Route::resource('message', MessageController::class);
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});