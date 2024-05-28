<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\JualController;
use App\Http\Controllers\BeliController;

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

    Route::resource('supplier',SupplierController::class);
    Route::get('/supplier', [SupplierController::class, 'supplier'])->name('supplier');

    Route::resource('customer',CustomerController::class);
    Route::get('/customer', [CustomerController::class, 'customer'])->name('customer');

    Route::resource('beli',BeliController::class);
    Route::get('/pembelian', [BeliController::class, 'beli'])->name('pembelian');
    Route::get('/updateBayar/{no_bukti}', [BeliController::class, 'updateBayar'])->name('UpdateBayar');
    Route::get('/updateKirim/{no_bukti}', [BeliController::class, 'updateKirim'])->name('UpdateKirim');
    Route::get('/beliDetail/{no_bukti}', [BeliController::class, 'showDetail'])->name('BeliDetail');

    Route::resource('jual',JualController::class);
    Route::get('/penjualan', [JualController::class, 'jual'])->name('penjualan');
    Route::get('/updateBayarJual/{no_bukti}', [JualController::class, 'updateBayar'])->name('UpdateBayarJual');
    Route::get('/updateKirimJual/{no_bukti}', [JualController::class, 'updateKirim'])->name('UpdateKirimJual');

});
