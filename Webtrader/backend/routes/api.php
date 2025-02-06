<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller('IndexController')->group(function () {
    Route::get('testAuth', 'testAuth')->middleware('auth:sanctum')->name('test.auth');
});

Route::controller('AuthController')->namespace('Auth')->prefix('auth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    Route::post('/verify-otp', 'verifyOtp')->name('verify.register.otp');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth:sanctum');
    Route::post('/forgot-password/send-otp', 'send_otp')->name('password.send-otp');
    Route::post('/forgot-password/verify-otp', 'verify_password_otp')->name('password.verify-otp');
});

Route::namespace('External')->prefix('external')->name('external.')->group(function () {
    Route::controller('CoinmarketCapApiController')->prefix('cmp')->name('coinmarketcap.')->group(function () {
        Route::get('index/{start}/{limit}', 'index')->name('index');
    });
});
