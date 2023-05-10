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

Route::resource('/', App\Http\Controllers\DashboardController::class )->middleware(['auth']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cek', [App\Http\Controllers\CekController::class, 'index']);

<<<<<<< HEAD
Route::resource('/pembayaran', App\Http\Controllers\PembayaranController::class);
Route::post('/pembayaran/aktivasi', [App\Http\Controllers\PembayaranController::class], 'aktivasi');
Route::resource('/users', App\Http\Controllers\UserController::class );
=======
Route::resource('/pembayaran', App\Http\Controllers\PembayaranController::class)->middleware(['auth']);;
Route::resource('/users', App\Http\Controllers\UserController::class )->middleware(['auth']);
>>>>>>> b243eeee98d961ddd8016ea695181f076eecf67f
