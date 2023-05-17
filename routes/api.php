<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PendaftaranController;
use App\Http\Controllers\BsiApiController;

use App\Http\Controllers\TransaksiPmbController;


Route::prefix('v1')->group(function () {
    Route::post('/transactions', [TransaksiPmbController::class, 'store']);
});

Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
Route::post('/pendaftaran', [PendaftaranController::class, 'store']);
Route::get('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'show']);
Route::put('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'update']);
Route::delete('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'destroy']);

Route::post('/generate-va', function (Request $request) {
    // Proses pembuatan VA dan mengirimkan data ke API BSI
});
