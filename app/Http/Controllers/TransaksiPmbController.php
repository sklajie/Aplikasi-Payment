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

class TransaksiPmbController extends Controller
{
    private $apiToken;
    private $bsiApiClient;

    // public function __construct(BsiApiClient $bsiApiClient)
    // {
    //     $this->bsiApiClient = $bsiApiClient; // Mendapatkan token saat inisialisasi
    // }

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

        // Kirim permintaan ke API Bank BSI dengan menggunakan token
        $response = $this->sendApiRequest('https://billing-bpi-dev.maja.id/api/v2/register', $requestData);
        
        return response()->json($response);
    }

    public function requestVa(Request $request)
    {
        // Ambil data yang diperlukan dari permintaan
        $name = $request->input('name');
        $email = $request->input('email');
        $regisNumber = $request->input('regis_number');
        $amount = $request->input('amount');
        $createdDate = $request->input('created_date');

        // penyimpanan data ke database
        $transaction = new Transaksi();
        $transaction->name = $name;
        $transaction->email = $email;
        $transaction->regis_number = $regisNumber;
        $transaction->amount = $amount;
        $transaction->created_date = $createdDate;
        $transaction->save();

        // Memanggil fungsi createVa untuk membuat VA
        $response = $this->createVa($request, $token);

        // Kirim permintaan ke API Bank BSI
        $response = $this->sendApiRequest('https://billing-bpi-dev.maja.id/api/v2/register', $requestData);

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
                'code' => 'XX',
                'message' => 'Error occurred',
                'success' => false,
                'data' => null,
            ];

            return $responseBody;
        }

        // Mengirim permintaan ke Bank BSI untuk membuat VA
        $response = $this->sendApiRequest('https://billing-bpi-dev.maja.id/api/v2/register', [
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

    public function getApiToken()
    {
        return $this->bsiApiClient->getToken();
    }

    private function sendApiRequest($url, $requestData)
    {
        return $this->bsiApiClient->sendRequest($url, $data);
    }

    public function index(){
        return view('akses');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'regis_number' => 'required',
                'amount' => 'required|numeric',
                'user_id' => 'required',
            ]);

            DB::beginTransaction();

            // Simpan data pembayaran_lainnya
            $pembayaranLainnya = PembayaranLainnya::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'regis_number' => $data['regis_number'],
                'amount' => (int) $data['amount'],
            ]);
            
            $pembayaranLainnyaId = $pembayaranLainnya->id;

            // Buat data untuk dikirim ke Bank BSI
            $requestData = [
                'date' => date('Y-m-d'),
                'amount' => (int)$data['amount'],
                'va' => $data['regis_number'],
                'name' => $data['name'],
                'email' => $data['email'],
                'items' => [
                    [
                        'description' => 'Pembayaran PMB',
                        'unitPrice' => (int)$data['amount'],
                        'qty' => 1,
                        'amount' => (int)$data['amount']
                    ]
                ],
                'attributes' => [],
            ];

            // Kirim permintaan ke Bank BSI
            $response = Http::asForm()->post('https://account.makaramas.com/auth/realms/bpi-dev/protocol/openid-connect/token', [
                'grant_type' => 'password',
                'client_id' => 'BPI3764',
                'client_secret' => 'cJ33C8xjyVbxTNTKCnqgrxoZaCsnvRep',
                'username' => '3764',
                'password' => '3764',
            ]);

            $accessToken = $response->json('access_token');

            $responseApi = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->post('https://billing-bpi-dev.maja.id/api/v2/register', $requestData);

            // Simpan data histori respons ke dalam tabel Histori
            $histori = Histori::create([
                'pembayaran_lainnya_id' => $pembayaranLainnyaId,
                'method' => 'Metode Pembayaran',
                'request_body' => json_encode($requestData),
                'respons' => json_encode($responseApi->json()),
                'user_id' => $data['user_id'],
            ]);
            
            $historiUserId = $histori->user_id;

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data histori request berhasil disimpan dan permintaan ke Bank BSI berhasil dikirim',
                'data' => $histori,
            ], 201); // Gunakan status HTTP 201 Created
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data histori request atau mengirim permintaan ke Bank BSI',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function receiveBpiNotification(Request $request)
    {
        try {
            $data = $request->validate([
                'va' => 'required',
                'date' => 'required',
                'message' => 'required',
                'amount' => 'required',
            ]);
    
            // Dapatkan data va dari notifikasi
            $va = $data['va'];
    
            // Cari entri pembayaran_lainnya yang sesuai dengan regis_number yang cocok dengan va
            $pembayaranLainnya = PembayaranLainnya::where('regis_number', $va)->first();
    
            if (!$pembayaranLainnya) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid virtual account.',
                ]);
            }
    
            // Simpan notifikasi dalam tabel notifications
            $notification = Notification::create([
                'pembayaran_lainnya_id' => $pembayaranLainnya->id,
                'message' => $data['message'],
                'data' => json_encode($request->except(['va', 'message'])),
            ]);
    
            // Ambil endpoint dari tabel users berdasarkan user_id yang terkait dengan pembayaran_lainnya
            $user = $pembayaranLainnya->histori->user;
            $endpoint = $user->endpoint;
    
            // Kirim notifikasi ke endpoint
            // Formatkan data notifikasi sesuai dengan kebutuhan endpoint
            $data = [
                'message' => $notification->message,
                'data' => json_decode($notification->data, true),
            ];

            dd($data);

            // Kirim data notifikasi ke endpoint menggunakan HTTP POST request
            $client = new Client();
            $response = $client->post($endpoint, [
                'json' => $data,
            ]);
    
            // Mengirim respons
            return response()->json([
                'success' => true,
                'message' => 'Notification received and processed successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses notifikasi.',
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
