<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('loginform');
Route::post('/checkLogin', [BankController::class, 'checkLogin'])->name('checkLogin');
Route::get('/registration', function () {
    return view('registration');
})->name('registrationform');
Route::post('/createAccount', [BankController::class, 'createAccount'])->name('createAccount');
Route::get('/home', function () {
    return view('home');
})->name('home');
Route::get('/deposit', function () {
    return view('deposit');
})->name('deposit');
Route::post('/depositAmount', [BankController::class, 'depositAmount'])->name('depositAmount');
Route::get('/withdraw', function () {
    return view('withdraw');
})->name('withdraw');
Route::post('/withdrawAmount', [BankController::class, 'withdrawAmount'])->name('withdrawAmount');
Route::get('/transfer', function () {
    return view('transfer');
})->name('transfer');
Route::post('/transferAmount', [BankController::class, 'transferAmount'])->name('transferAmount');
Route::get('/statement', [BankController::class, 'statement'])->name('statement');
Route::get('/logout', function () {
    Session::forget('id');
    Session::forget('name');
    Session::forget('email');
    Session::forget('balance');
    return redirect(route('loginform'));
})->name('logout');
