<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $title = 'Data Pembayaran';
        return view('pages.pembayaran' , compact('title'));
    }
}
