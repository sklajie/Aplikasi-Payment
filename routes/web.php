<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\PembayaranController;
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

Route::resource('/', App\Http\Controllers\DashboardController::class )->middleware(['auth','adminapps']);

route::get('/cek', function(){
    return view('pdf.invoice_pembayaran_ukt');
});

Auth::routes();

Route::get('/pembayaran', 'App\Http\Controllers\PembayaranController@index')->middleware(['auth', 'adminkeuangan']);
Route::any('/pembayaran/data', 'App\Http\Controllers\PembayaranController@data')->middleware(['auth', 'adminkeuangan']);
Route::get('/pembayaran/export','App\Http\Controllers\PembayaranController@exportData')->middleware(['auth', 'adminkeuangan']);
Route::get('/pembayaran/download_pdf/{id}','App\Http\Controllers\PembayaranController@downloadPdf')->middleware(['auth', 'adminkeuangan']);
Route::post('/pembayaran/aktivasi', [App\Http\Controllers\PembayaranController::class], 'aktivasi');
Route::resource('/users', App\Http\Controllers\UserController::class )->middleware(['auth', 'superadmin']);
Route::resource('/kategori_pembayaran', App\Http\Controllers\KategoriPembayaranController::class )->middleware(['auth', 'adminkeuangan']);

