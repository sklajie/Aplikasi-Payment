<?php

namespace App\Http\Controllers;

use App\Models\HistoriPembayaran;
use Illuminate\Http\Request;

class HistoriPembayaranController extends Controller
{
    public function index()
    {
        $title = 'Histori Pembayaran';
        $data = HistoriPembayaran::orderByDesc('tanggal_bayar')->get();
        return view('pages.historiPembayaran', compact('data','title'));

    }
}
