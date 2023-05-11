<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PendaftaranController;

Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
Route::post('/pendaftaran', [PendaftaranController::class, 'store']);
Route::get('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'show']);
Route::put('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'update']);
Route::delete('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'destroy']);

Route::post('/generate-va', function (Request $request) {
    // Proses pembuatan VA dan mengirimkan data ke API BSI
});
