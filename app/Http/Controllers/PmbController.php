<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PmbController extends Controller
{
    public function index(){
        return view('akses');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'regis_number' => 'required',
            'amount' => 'required|numeric',
        ]);


        // try {
        //     $data = $request->validate([
        //         'name' => 'required',
        //         'email' => 'required|email',
        //         'va' => 'required',
        //         'user_id' => 'required',
        //         'amount' => 'required|numeric',
        //         'date' => 'required|date',
        //         // 'attribute1' => 'nullable',
        //         // 'attribute2' => 'nullable',
        //         'items' => 'required|array',
        //         'items.*.description' => 'required',
        //         'items.*.unitPrice' => 'required|numeric',
        //         'items.*.qty' => 'required|integer',
        //         'items.*.amount' => 'required|numeric',
        //         'attributes' => 'nullable|array',
        //     ]);
            
        //     DB::beginTransaction();
            
            // // Simpan data histori request ke dalam tabel HistoriRequest
            // $historiRequest = HistoriRequest::create([
            //     'name' => $data['name'],
            //     'email' => $data['email'],
            //     'regis_number' => $data['regis_number'],
            //     'amount' => (int)$data['amount'],
            //     'user_id' => '133759c4-c0d0-4396-bfa4-fe4851c9c303',
            //     'created_date' => now(), // Tanggal dibuat (sekarang)
            // ]);
            
            // // Buat data untuk dikirim ke Bank BSI
            // $requestData = [
            //     'date' => date('Y-m-d'), 
            //     'amount' => (int)$data['amount'],
            //     'va' => $data['regis_number'],
            //     'name' => $data['name'],
            //     'email' => $data['email'],
            //     'items' => [
            //         [
            //             'description'=>'Pembayaran PMB',
            //             'unitPrice' => (int)$data['amount'],
            //             'qty'=> 1,
            //             'amount'=> (int)$data['amount']
            //         ]
            //     ],
            //     'attributes' => [],
            // ];

            // // Kirim permintaan ke Bank BSI 
            // $response = Http::asForm()->post('https://account.makaramas.com/auth/realms/bpi-dev/protocol/openid-connect/token', [
            //     'grant_type' => 'password',
            //     'client_id' => 'BPI3764',
            //     'client_secret' => 'cJ33C8xjyVbxTNTKCnqgrxoZaCsnvRep',
            //     'username' => '3764',
            //     'password' => '3764',
            // ]);
            
            // $accessToken = $response->json('access_token');
            
            // $responseApi = Http::withHeaders([
            //     'Authorization' => 'Bearer ' . $accessToken,
            // ])->post('https://billing-bpi-dev.maja.id/api/v2/register', $requestData);

            // dd($responseApi->json());
    
        //     // Simpan data histori respons ke dalam tabel HistoriRespons
        //     $historiRespons = HistoriRespons::create([
        //         'name' => $data['name'],
        //         'email' => $data['email'],
        //         'regis_number' => $data['va'],
        //         'amount' => $data['amount'],
        //         'created_date' => $data['date'],
        //         'response' => $response->json(),
        //     ]);

        //     // Periksa apakah data histori request berhasil disimpan
        //     if ($historiRequest) {
        //         // Periksa status respons dari Bank BSI
        //         if ($response->successful()) {
        //             // Simpan data respons ke tabel HistoriRespons
        //             $historiRespons->save();
    
        //             // Hubungkan data histori respons dengan histori request
        //             $historiRequest->historiRespons()->save($historiRespons);
    
        //             DB::commit();
    
        //             return response()->json([
        //                 'success' => true,
        //                 'message' => 'Data histori request berhasil disimpan dan permintaan ke Bank BSI berhasil dikirim',
        //                 'data' => $historiRequest,
        //             ], 201); // Gunakan status HTTP 201 Created
        //         } else {
        //             DB::rollback();
    
        //             return response()->json([
        //                 'success' => false,
        //                 'message' => 'Data histori request berhasil disimpan tetapi terjadi kesalahan saat mengirim permintaan ke Bank BSI',
        //             ], 500); // Gunakan status HTTP 500 Internal Server Error
        //         }
        //     } else {
        //         DB::rollback();
    
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'Data histori request gagal disimpan',
        //         ], 400); // Gunakan status HTTP 400 Bad Request
        //     }
        // } catch (\Exception $e) {
        //     DB::rollback();
    
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Terjadi kesalahan saat menyimpan data histori request atau mengirim permintaan ke Bank BSI',
        //         'error' => $e->getMessage(),
        //     ], 500);
        // }
    }
}