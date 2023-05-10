<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranLainnyaController extends Controller
{
    public function index()
    {
        $title = 'Pembayaran Lainnya';
        
        return view('pages.pembayaran_lainnya' , compact('title'));
    }
}
