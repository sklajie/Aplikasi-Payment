<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
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
            // Jika ditemukan, kirim respons dengan informasi pembayaran
            return response()->json([
                'success' => true,
                'data' => $pembayaran
            ]);
        } else {
            // Jika tidak ditemukan, kirim respons dengan pesan error
            return response()->json([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan'
            ], 404);
        }
    }
}
