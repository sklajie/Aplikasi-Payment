<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
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

Auth::routes();

Route::post('/pembayaran/aktivasi', [App\Http\Controllers\PembayaranController::class], 'aktivasi');
Route::resource('/pembayaran', App\Http\Controllers\PembayaranController::class)->middleware(['auth', 'superadmin']);
Route::resource('/users', App\Http\Controllers\UserController::class )->middleware(['auth', 'superadmin']);
