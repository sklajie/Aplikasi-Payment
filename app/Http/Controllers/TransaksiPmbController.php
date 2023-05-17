<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Clients\BsiApiClient;
use App\Models\Pendaftaran;
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

    public function createVa(Request $request)
    {
        // Mengirim permintaan ke Bank BSI untuk membuat VA
        $response = Http::post('https://api.bankbsi.co.id/va/create', [
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
    
            return response()->json($responseBody);
        }
    }
    // public function createTransaction(Request $request)
    // {
    //     $transaction = Transaksi::where('transaction_id', $transactionId)->first();
    //     if ($transaction) {
    //         $transaction->va = $va;
    //         $transaction->save();   
    //     }

    //     return response()->json(['success' => true]);
    // }

    public function store(Request $request)
    {
        
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'va' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $pendaftaran = Pendaftaran::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'nomer_registrasi' => $data['va'],
            'jumlah_uang' => $data['amount'],
            'tanggal_bayar' => $data['date'],
        ]);

        if ($pendaftaran) {
            return response()->json([
                'success' => true,
                'message' => 'Data pendaftaran berhasil disimpan'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data pendaftaran gagal disimpan'
            ]);
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
