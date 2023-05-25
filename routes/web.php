<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\DokumentasiController;
use App\Services\BillingApi;

use App\Http\Controllers\TransaksiPmbController;

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
    return view('pages/log_transaksi');
});

Auth::routes();

Route::get('/pembayaran', 'App\Http\Controllers\PembayaranController@index')->middleware(['auth', 'adminkeuangan']);
Route::any('/pembayaran/data', 'App\Http\Controllers\PembayaranController@data')->middleware(['auth', 'adminkeuangan']);
Route::get('/pembayaran/export','App\Http\Controllers\PembayaranController@exportData')->middleware(['auth', 'adminkeuangan']);
Route::get('/pembayaran/download_pdf/{id}','App\Http\Controllers\PembayaranController@downloadPdf')->middleware(['auth', 'adminkeuangan']);
Route::put('/pembayaran/import-excel','App\Http\Controllers\PembayaranController@importDataMahasiswa')->middleware(['auth', 'adminkeuangan']);
Route::post('/pembayaran/export_data_terpilih','App\Http\Controllers\PembayaranController@exportDataTerpilih')->middleware(['auth', 'adminkeuangan']);
Route::post('/pembayaran/aktivasi_va','App\Http\Controllers\PembayaranController@aktivasiVA')->middleware(['auth', 'adminkeuangan']);
Route::post('/pembayaran/aktivasi', [App\Http\Controllers\PembayaranController::class], 'aktivasi');

Route::resource('/users', App\Http\Controllers\UserController::class )->middleware(['auth', 'superadmin']);

Route::resource('/kategori_pembayaran', App\Http\Controllers\KategoriPembayaranController::class )->middleware(['auth', 'adminkeuangan']);

Route::post('/bsi-callback', [TransaksiPmbController::class, 'bsiCallback'])->name('bsi-callback');


Route::resource('/profil', 'App\Http\Controllers\ProfilController')->middleware(['auth']);
Route::resource('/api/production', 'App\Http\Controllers\ProductionController')->middleware(['auth']);
Route::get('/dokumentasi/production', [App\Http\Controllers\ProductionController::class, 'dokumentasi'])->middleware(['auth']);
Route::get('/api/sandbox', [App\Http\Controllers\SandboxController::class, 'index'])->middleware(['auth']);
Route::get('/dokumentasi/sandbox', [App\Http\Controllers\SandboxController::class, 'dokumentasi'])->middleware(['auth']);

Route::get('/log_transaksi', 'App\Http\Controllers\PembayaranLainnyaController@index');
Route::any('/log_transaksi/data', 'App\Http\Controllers\PembayaranLainnyaController@data');
Route::any('/log_transaksi/detail/{pembayaran_id}', 'App\Http\Controllers\PembayaranLainnyaController@showDetail');