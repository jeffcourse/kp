<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\JualController;
use App\Http\Controllers\BeliController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\GudangController;

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
    Route::get('/', [HomeController::class, 'welcome'])->name('home');

    Route::resource('master',MasterController::class);
    Route::get('/master', [MasterController::class, 'master'])->name('master');
    Route::post('/updateQuantity',[MasterController::class, 'updateQuantity'])->name('UpdateQuantity');
    Route::get('/opnameBarang',[MasterController::class, 'opnameBarang'])->name('OpnameBarang');

    Route::resource('supplier',SupplierController::class);
    Route::get('/supplier', [SupplierController::class, 'supplier'])->name('supplier');

    Route::resource('customer',CustomerController::class);
    Route::get('/customer', [CustomerController::class, 'customer'])->name('customer');

    Route::resource('salesPerson',SalesController::class);
    Route::get('/salesPerson',[SalesController::class, 'salesPerson'])->name('salesPerson');

    Route::resource('gudang',GudangController::class);
    Route::get('/gudang',[GudangController::class, 'gudang'])->name('gudang');

    Route::resource('beli',BeliController::class);
    Route::get('/pembelian', [BeliController::class, 'beli'])->name('pembelian');
    Route::get('/updateBayar', [BeliController::class, 'updateBayar'])->name('UpdateBayar');
    Route::get('/updateKirim', [BeliController::class, 'updateKirim'])->name('UpdateKirim');
    Route::get('/beliDetail/{no_bukti}', [BeliController::class, 'showDetail'])->name('BeliDetail');
    Route::get('/fakturBeli/{no_bukti}', [BeliController::class, 'cetak_pdf'])->name('BeliPdf');

    Route::resource('jual',JualController::class);
    Route::get('/penjualan', [JualController::class, 'jual'])->name('penjualan');
    Route::get('/updateBayarJual', [JualController::class, 'updateBayar'])->name('UpdateBayarJual');
    Route::get('/updateKirimJual', [JualController::class, 'updateKirim'])->name('UpdateKirimJual');
    Route::get('/jualDetail/{no_bukti}', [JualController::class, 'showDetail'])->name('JualDetail');
    Route::get('/invoice/{no_bukti}', [JualController::class, 'cetak_pdf'])->name('JualPdf');

    Route::get('/report/beliLunas', [BeliController::class, 'belumLunasReport'])->name('BeliLunas');
    Route::get('/report/beliKirim', [BeliController::class, 'belumKirimReport'])->name('BeliKirim');
    Route::get('/report/jualLunas', [JualController::class, 'belumLunasReport'])->name('JualLunas');
    Route::get('/report/jualKirim', [JualController::class, 'belumKirimReport'])->name('JualKirim');

});
