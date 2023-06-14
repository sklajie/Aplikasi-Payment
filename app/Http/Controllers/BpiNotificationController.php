<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Histori;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\HistoriRequest;
use App\Models\HistoriRespons;
use App\Models\PembayaranLainnya;

use App\Http\Clients\BsiApiClient;
use App\Models\HistoriPembayaran;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

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

            $pembayaran = Pembayaran::where('va', $va)->first();

            if ($pembayaranLainnya) {
                if ($data['message'] == 'Payment Sukses') {
                    $pembayaranLainnya->paid = '1';
                    $pembayaranLainnya->paid_date = now();
                    $pembayaranLainnya->save();
                }

                // Simpan notifikasi dalam tabel notifications
                $notification = Notification::create([
                    'pembayaran_lainnya_id' => $pembayaranLainnya->id,
                    'message' => $data['message'],
                    'data' => json_encode($request->except(['va', 'message'])),
                ]);

                DB::commit();

                // Ambil endpoint dari tabel users berdasarkan user_id yang terkait dengan pembayaran_lainnya
                $user = $pembayaranLainnya->histori->user;
                $userId = $user->id;
                $endpoint = $user->endpoint;

                // Kirim notifikasi ke endpoint
                // Formatkan data notifikasi sesuai dengan kebutuhan endpoint
                $data = [
                    'message' => $notification->message,
                    'data' => json_decode($notification->data, true),
                ];

                dd($data);

                // Kirim data notifikasi ke endpoint menggunakan HTTP POST request
                $response = http::post($endpoint, $data);

                // Menyimpan data notifikasi ke histori
                $histori = Histori::create([
                    'pembayaran_lainnya_id' => $pembayaranLainnya->id,
                    'method' => $request->method(),
                    'endpoint' => $request->fullUrl(),
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

                //pembayaran UKT
            } elseif ($pembayaran) {
                if ($data['message'] == 'Payment Sukses') {
                    $pembayaran->status = 'dibayar';
                    $pembayaran->date = now();
                    $pembayaran->save();
                }

                // Ambil endpoint dari tabel users berdasarkan user_id yang terkait dengan pembayaran
                $id_user = $pembayaran->user_id;
                $user = User::find($id_user);
                $endpoint = $user->endpoint;

                // Simpan notifikasi dalam tabel notifications
                $notification = Notification::create([
                    'user_id' => $pembayaran->user_id,
                    'message' => $data['message'],
                    'data' => json_encode($request->except(['va', 'message'])),
                ]);
                

                DB::commit();

                // Kirim notifikasi ke endpoint
                // Formatkan data notifikasi sesuai dengan kebutuhan endpoint
                $data = [
                    'message' => $notification->message,
                    'data' => json_decode($notification->data, true),
                ];

                // Kirim data notifikasi ke endpoint menggunakan HTTP POST request
                $response = http::post($endpoint, $data);

                // Menyimpan data notifikasi ke histori
                $histori = HistoriPembayaran::create([
                    'nama_pembayar' => $data['name'],
                    'amount' => $data['amount'],
                    'va' => $data['va'],
                    'number' => $data['number'],
                    'tanggal_bayar' => $data['date'],
                    'pembayaran_id' => $pembayaran->id,
                    'method' => $request->method(),
                    'endpoint' => $request->fullUrl(),
                    'mode' => 'production',
                    'request_body' => json_encode($data),
                    'respons' => $response->body(),
                ]);

                DB::commit();

                // Mengirim respons
                return response()->json([
                    'timestamp' => date('m/d/Y, h:i:s A'),
                    'success' => $response->getStatusCode() != 200 ? false : true,
                    'message' => $response->getStatusCode() != 200 ? 'terjadi kesalahan yang tidak diketahui' : 'notifikasi diterima dan proses kirim berhasil.',
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();

            // Menyimpan data notifikasi ke histori
            $histori = Histori::create([
                'pembayaran_lainnya_id' => $pembayaranLainnya->id,
                'method' => $request->method(),
                'endpoint' => $request->fullUrl(),
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
