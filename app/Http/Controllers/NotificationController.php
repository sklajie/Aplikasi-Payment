<?php

namespace App\Http\Controllers;

use App\Models\Histori;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // public function receiveNotification(Request $request)
    // {
    //     try {
    //         $data = $request->validate([
    //             'va' => 'required',
    //             'date' => 'required',
    //             'message' => 'required',
    //             'amount' => 'required',
    //         ]);

    //         // Dapatkan data va dari notifikasi
    //         $va = $data['va'];

    //         // Cari histori pembayaran berdasarkan va
    //         $histori = Histori::whereHas('transaksiPmb', function ($query) use ($va) {
    //             $query->where('va', $va);
    //         })->first();

    //         dd($histori);

    //         if (!$histori) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Invalid virtual account.',
    //             ]);
    //         }

    //         // Simpan notifikasi dalam tabel notifications
    //         $notification = Notification::create([
    //             'message' => $data['message'],
    //             'data' => json_encode($request->except(['va', 'message'])),
    //         ]);

    //         // Simpan relasi antara histori dan notifikasi
    //         HistoriNotifikasi::create([
    //             'histori_id' => $histori->id,
    //             'notification_id' => $notification->id,
    //         ]);

    //         // Ambil user berdasarkan histori
    //         $user = $histori->user;

    //         // Ambil endpoint dari user
    //         $endpoint = $user->endpoint;

    //         // Kirim notifikasi ke endpoint
    //         // Lakukan implementasi pengiriman notifikasi ke endpoint sesuai dengan kebutuhan Anda

    //         // Mengirim respons ke app payment
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Notification received and processed successfully.',
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Terjadi kesalahan saat memproses notifikasi.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
}
