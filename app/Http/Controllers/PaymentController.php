<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Pembayaran;



class PaymentController extends Controller
{
    
    
    public function index(Request $request, $nim)
    {
        $user = User::all();
        return view('siakad.table_pembayaran')->with('user', $user);
    }

    public function processPayment(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nim' => 'required'
        ]);

        // Ambil data NIM dari permintaan
        $nim = $request->input('nim');

        // Cari semua informasi pembayaran berdasarkan NIM di tabel pembayaran
        $pembayaran = DB::table('pembayaran')
            ->where('nim', $nim)
            ->get();

        if ($pembayaran->count() > 0) {
            // Jika ditemukan, kirim respons dengan informasi pembayaran dan nim
        return view('siakad.table_pembayaran')->with('pembayaran', $pembayaran)->with('nim', $nim);
        } else {
            // Jika tidak ditemukan, kirim respons dengan pesan error
            return response()->json([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan'
            ], 404);
        }
    }
    public function invoice($id){
        $title = 'Invoice';
        $invoice = pembayaran::find($id);
        return view('siakad.invoice', compact('title','invoice'));
    }
}
