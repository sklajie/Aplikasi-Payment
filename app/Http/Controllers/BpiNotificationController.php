<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\HistoriRequest;
use App\Models\HistoriRespons;
use App\Models\Histori;
use App\Models\PembayaranLainnya;
use App\Models\Notification;
use App\Http\Clients\BsiApiClient;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

use GuzzleHttp\Client;

class BpiNotificationController extends Controller
{
    public function receiveBpiNotification(Request $request)
    {
        try {
            $data = $request->validate([
                'va' => 'required',
                'date' => 'required',
                'message' => 'required',
                'amount' => 'required',
            ]);

            DB::beginTransaction();
    
            // Dapatkan data va dari notifikasi
            $va = $data['va'];
    
            // Cari entri pembayaran_lainnya yang sesuai dengan regis_number yang cocok dengan va
            $pembayaranLainnya = PembayaranLainnya::where('regis_number', $va)->first();

            if ($data['message'] == 'Payment Sukses') {
                $updatestatus = PembayaranLainnya::where('regis_number', $va)->first();
            
                if ($updatestatus) {
                    // Jika data ditemukan di tabel PembayaranLainnya
                    $updatestatus->paid = '1';
                    $updatestatus->paid_date = $data['date'];
                    $updatestatus->save();
                } else {
                    // Jika data tidak ditemukan di tabel PembayaranLainnya, cek di tabel Pembayaran
                    $updatestatus = Pembayaran::where('regis_number', $va)->first();
            
                    if ($updatestatus) {
                        $updatestatus->paid = '1';
                        $updatestatus->paid_date = $data['date'];
                        $updatestatus->save();
                    }
                }
            }
    
            if (!$pembayaranLainnya) {
                return response()->json([
                    'timestamp' => date('m/d/Y, h:i:s A'),
                    'success' => false,
                    'message' => 'virtual account salah.',
                ]);
            }
    
            // Simpan notifikasi dalam tabel notifications
            $notification = Notification::create([
                'pembayaran_lainnya_id' => $pembayaranLainnya->id,
                'message' => $data['message'],
                'data' => json_encode($request->except(['va', 'message'])),
            ]);
            DB::commit();

    
            //Ambil endpoint dari tabel users berdasarkan user_id yang terkait dengan pembayaran_lainnya 

            DB::beginTransaction();
            
            $user = $pembayaranLainnya->histori->user;
            $userId = $user->id;
            $endpoint = $user->endpoint;
    
            // Kirim notifikasi ke endpoint
            // Formatkan data notifikasi sesuai dengan kebutuhan endpoint
            $data = [
                'message' => $notification->message,
                'data' => json_decode($notification->data, true),
            ];

            //Kirim data notifikasi ke endpoint menggunakan HTTP POST request

            $response = http::post($endpoint, [
                'json' => $data,
            ]);

            $method = $request->method();
            $endpointapi = $request->fullUrl();
            $endpointAPI = strval($endpointapi);
    

            //Menyimpan data notifikasi ke histori
            $histori = Histori::create([
                'pembayaran_lainnya_id' => $pembayaranLainnya->id,
                'method' => $method,
                'endpoint' => $endpointAPI ,
                'mode' => 'production',
                'request_body' => json_encode($data),
                'respons' => $response->body(),
                'user_id' => $userId,
            ]);

            DB::commit();
            // Mengirim respons
            return response()->json([
                'timestamp' => date('m/d/Y, h:i:s A'),
                'success' => $response->getStatusCode() != 200 ? false : true,
                'message' => $response->getStatusCode() != 200 ? 'terjadi kesalahan yang tidak diketahui' : 'notifikasi diterima dan proses kirim berhasil.',
            ]);
        } catch (\Exception $e) {

            DB::rollback();

            
            $method = $request->method();
            $endpointapi = $request->fullUrl();
            $endpointAPI = strval($endpointapi);
    

            //Menyimpan data notifikasi ke histori
            $histori = Histori::create([
                'pembayaran_lainnya_id' => $pembayaranLainnya->id,
                'method' => $method,
                'endpoint' => $endpointAPI ,
                'mode' => 'production',
                'request_body' => json_encode($data),
                'respons' => $response->body(),
                'user_id' => $userId,
            ]);

            return response()->json([
                'timestamp' => date('m/d/Y, h:i:s A'),
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses notifikasi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
