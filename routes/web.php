<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;

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

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'registerPost'])->name('register.post');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    
    Route::resource('master',MasterController::class);
    Route::get('/master', [MasterController::class, 'master'])->name('master');

    Route::get('/transactions', function(){
        return "Ini transaksi";
    })->name('transactions');

    Route::get('/supplier', function(){
        return "Ini supplier";
    })->name('supplier');

    Route::get('/customer', function(){
        return "Ini customer";
    })->name('customer');
});
