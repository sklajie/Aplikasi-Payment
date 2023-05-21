<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\HistoriRequest;
use App\Models\HistoriRespons;
use App\Http\Clients\BsiApiClient;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;



class TransaksiPmbController extends Controller
{
    public function createTransaction(Request $request)
    {
        // Mendapatkan data dari permintaan
        $transactionId = $request->input('number');
        $va = $request->input('va');

        // Mencari transaksi berdasarkan ID transaksi
        $transaction = Transaksi::where('transaction_id', $transactionId)->first();

        // Memperbarui VA pada transaksi jika ditemukan
        if ($transaction) {
            $transaction->va = $va;
            $transaction->save();
        }

        return response()->json([
            'timestamp' => date('m/d/Y, h:i:s A'),
            'code' => '00',
            'message' => 'success',
            'success' => true,
        ]);
    }
    
    public function requestVa(Request $request)
    {
        // Ambil data yang diperlukan dari permintaan
        $name = $request->input('name');
        $email = $request->input('email');
        $regisNumber = $request->input('regis_number');
        $amount = $request->input('amount');
        $createdDate = $request->input('created_date');

        // Lakukan logika atau pemrosesan lainnya dengan data yang diambil

        // penyimpanan data ke database
        $transaction = new Transaksi();
        $transaction->name = $name;
        $transaction->email = $email;
        $transaction->regis_number = $regisNumber;
        $transaction->amount = $amount;
        $transaction->created_date = $createdDate;
        $transaction->save();

        // Memanggil fungsi createVa untuk membuat VA
        $response = $this->createVa($request);

        // Menyiapkan respons yang sesuai
        $responseBody = [
            'timestamp' => date('m/d/Y, h:i:s A'),
            'code' => '00',
            'message' => 'success',
            'success' => true,
            'data' => [
                'va' => $response['data']['va'],
            ],
        ];

        // Menyimpan data respon ke database
        $transaction->va = $response['data']['va'];
        $transaction->save();

        return response()->json($responseBody);
    }

    public function createVa(Request $request)
    {
        // Mensimulasikan respons error dari API Bank BSI
        $simulateError = false; // Ubah menjadi false jika ingin menghilangkan simulasi error

        if ($simulateError) {
            // Menyiapkan respons error simulasi
            $responseBody = [
                'timestamp' => date('m/d/Y, h:i:s A'),
                'code' => '99',
                'message' => 'Simulated error response from API Bank BSI',
                'success' => false,
                'error' => 'Simulated Error',
            ];

            // Mengirim respons error ke app PMB
            return response()->json($responseBody, 500);
        }

        // Mengirim permintaan ke Bank BSI untuk membuat VA
        $response = Http::post('https://billing-bpi-dev.maja.id/api/v2/register', [
            'va' => $request->input('va'),
        ]);

        // Memeriksa status respons dari Bank BSI
        if ($response->successful()) {
            // Mendapatkan respons dalam bentuk array
            $responseData = $response->json();

            // Mendapatkan VA dari respons
            $va = $responseData['va'];

            // Menyimpan VA ke dalam transaksi
            $transactionId = $request->input('number');
            $transaction = Transaksi::where('transaction_id', $transactionId)->first();
            if ($transaction) {
                $transaction->va = $va;
                $transaction->save();
            }

            // Menyiapkan respons yang sesuai
            $responseBody = [
                'timestamp' => date('m/d/Y, h:i:s A'),
                'code' => '00',
                'message' => 'success',
                'success' => true,
                'data' => [
                    'va' => $va,
                ],
            ];

            // Menyimpan data respon ke database
            if ($transaction) {
                $historiRespons = new HistoriRespons();
                $historiRespons->respons = $responseData;
                $transaction->historiRespons()->save($historiRespons);
            }

            return response()->json($responseBody);
        } else {
            // Menyimpan error message dari respons
            $errorMessage = $response->json()['message'];

            // Menyiapkan respons error
            $responseBody = [
                'timestamp' => date('m/d/Y, h:i:s A'),
                'code' => '99',
                'message' => 'failed',
                'success' => false,
                'error' => $errorMessage,
            ];

            // Menyimpan data respon error ke database
            $transactionId = $request->input('number');
            $transaction = Transaksi::where('transaction_id', $transactionId)->first();
            if ($transaction) {
                $historiRespons = new HistoriRespons();
                $historiRespons->respons = $responseBody;
                $transaction->historiRespons()->save($historiRespons);
            }

            return response()->json($responseBody);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'va' => 'required',
                'user_id' => 'required',
                'amount' => 'required|numeric',
                'date' => 'required|date',
                'attribute1' => 'nullable',
                'attribute2' => 'nullable',
                'items' => 'required|array',
                'items.*.description' => 'required',
                'items.*.unitPrice' => 'required|numeric',
                'items.*.qty' => 'required|integer',
                'items.*.amount' => 'required|numeric',
                'attributes' => 'nullable|array',
            ]);
            
            // Simpan data histori request ke dalam tabel HistoriRequest
            $historiRequest = HistoriRequest::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'regis_number' => $data['va'],
                'amount' => $data['amount'],
                'user_id' => $data['user_id'],
                'created_date' => now(), // Tanggal dibuat (sekarang)
                'paid_date' => $data['date'],
                'attribute1' => $data['attribute1'],
                'attribute2' => $data['attribute2'],
                'items' => json_encode($data['items']),
                'attributes' => json_encode($data['attributes']),
            ]);

            
            // Buat data untuk dikirim ke Bank BSI
            $requestData = [
                'date' => $data['date'],
                'amount' => $data['amount'],
                'user_id' => $data['user_id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'va' => $data['va'],
                'attribute1' => $data['attribute1'],
                'attribute2' => $data['attribute2'],
                'items' => $data['items'],
                'attributes' => $data['attributes'],
            ];
            
            DB::beginTransaction();

            // Kirim permintaan ke Bank BSI
            $response = Http::post('https://billing-bpi-dev.maja.id/api/v2/register', $requestData);

            // Simpan data histori respons ke dalam tabel HistoriRespons
            $historiRespons = HistoriRespons::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'regis_number' => $data['va'],
                'amount' => $data['amount'],
                'created_date' => $data['date'],
                'response' => $response->json(),
            ]);

            // Periksa apakah data histori request berhasil disimpan
            if ($historiRequest) {
                // Kirim permintaan ke Bank BSI
                $response = Http::post('https://billing-bpi-dev.maja.id/api/v2/register', [
                    'data' => $data,
                ]);

                dd($response);

                // Periksa status respons dari Bank BSI
                if ($response->successful()) {
                    // Tanggapi respons yang diterima dari Bank BSI
                    $responseData = $response->json();

                    // Simpan data respons ke database
                    $historiRespons = new HistoriRespons([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'regis_number' => $data['va'],
                        'amount' => $data['amount'],
                        'created_date' => $data['date'],
                    ]);
                    $historiRespons->respons = $responseData;
                    $historiRespons->save();

                    $historiRequest->historiRespons()->save($historiRespons);

                    DB::commit();

                    return response()->json([
                        'success' => true,
                        'message' => 'Data histori request berhasil disimpan dan permintaan ke Bank BSI berhasil dikirim',
                        'data' => $historiRequest,
                    ], 201); // Gunakan status HTTP 201 Created
                } else {
                    DB::rollback();

                    return response()->json([
                        'success' => false,
                        'message' => 'Data histori request berhasil disimpan tetapi terjadi kesalahan saat mengirim permintaan ke Bank BSI',
                    ], 500); // Gunakan status HTTP 500 Internal Server Error
                }
            } else {
                DB::rollback();

                return response()->json([
                    'success' => false,
                    'message' => 'Data histori request gagal disimpan',
                ], 400); // Gunakan status HTTP 400 Bad Request
            }
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data histori request berhasil disimpan dan permintaan berhasil dikirim ke Bank BSI',
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data histori request atau mengirim permintaan ke Bank BSI',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    
    public function add(Request $request, $trx_id, $trx_status, $va_status, $va)
    {
        $transaction = Transaksi::where('transaction_id', $trx_id)->first();

        if (!$transaction) {
            $transaction = new Transaksi();
            $transaction->transaction_id = $trx_id;
            $transaction->status = 'PENDING';
            $transaction->va = $va;
            $transaction->amount = 0;
            $transaction->save();
        }

        if ($trx_status == 'SUCCESS') {
            $transaction->status = 'PAID';
            $transaction->paid_at = now();
            $transaction->save();

            $pembayaran = new TransaksiPembayaran();
            $pembayaran->transaksi_id = $transaction->id;
            $pembayaran->jumlah_pembayaran = $transaction->amount;
            $pembayaran->metode_pembayaran = 'bsi';
            $pembayaran->status_pembayaran = 'PAID';
            $pembayaran->tanggal_pembayaran = now();
            $pembayaran->save();
        }
        return response()->json(['success' => true]);
    }

    public function bsiCallback(Request $request)
    {
        $trx_id = $request->get('trx_id');
        $trx_status = $request->get('trx_status');
        $va_status = $request->get('va_status');

        $transaction = Transaction::where('trx_id', $trx_id)->first();

        if ($transaction) {
            $transaction->update([
                'status' => $trx_status,
                'va_status' => $va_status
            ]);

            if ($trx_status == 'PAID') {
                $transaction->markAsPaid();
            }
        }

        $data = [
            'timestamp' => date('n/j/Y, g:i:s A'),
            'code' => '00',
            'message' => 'success',
            'success' => true,
            'data' => $transaction->toArray()
        ];

        return response()->json($data);
    }


}
