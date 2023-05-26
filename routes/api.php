<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PendaftaranController;
use App\Http\Controllers\BsiApiController;
use App\Http\Controllers\PembayaranLainnyaController;
use App\Http\Controllers\TransaksiPmbController;
use App\Http\Controllers\NotificationController;


Route::prefix('v1')->group(function () {
    Route::post('/transactions', [TransaksiPmbController::class, 'store']);
    Route::post('/pembayaran_lainnya', [TransaksiPmbController::class, 'update']);
    Route::get('/DataTransactions', [PembayaranLainnyaController::class, 'DataTransaction']);
    Route::get('/DataDetailTransactions', [PembayaranLainnyaController::class, 'DataDetailTransaction']);
});

Route::prefix('v1')->group(function () {
    Route::post('/notification', [TransaksiPmbController::class, 'receiveBpiNotification']);
});

//test
Route::post('/webhook', [NotificationController::class, 'receiveNotification']);
//test

Route::post('/Pmb', [PmbController::class, 'store']);

Route::post('/create-va', [TransaksiPmbController::class, 'createVa']);

Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
Route::post('/pendaftaran', [PendaftaranController::class, 'store']);
Route::get('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'show']);
Route::put('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'update']);
Route::delete('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'destroy']);

Route::post('/generate-va', function (Request $request) {
    // Proses pembuatan VA dan mengirimkan data ke API BSI
});
