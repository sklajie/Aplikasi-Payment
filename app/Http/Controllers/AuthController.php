<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('bsi')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('bsi')->user();

        // Lakukan verifikasi dan otorisasi pengguna di sini
        
        // Contoh penyimpanan data pengguna ke dalam sesi
        session(['user' => $user]);

        // Redirect pengguna ke halaman setelah autentikasi selesai
        return redirect('/dashboard');
    }
}
