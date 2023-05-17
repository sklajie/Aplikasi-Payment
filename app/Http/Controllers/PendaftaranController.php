<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Services\BillingApi;
use App\Services\BsiApiService;
use App\Clients\MyApiClient;

class PendaftaranController extends Controller
{
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'va' => 'required|string|max:20',
            'number' => 'required|string|max:20',
            'attribute1' => 'nullable|string|max:255',
            'attribute2' => 'nullable|string|max:255',
            'sequenceNumber' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string|max:255',
            'items.*.unitPrice' => 'required|numeric',
            'items.*.qty' => 'required|numeric',
            'items.*.amount' => 'required|numeric',
            'attributes' => 'nullable|array',
        ]);

        // // Panggil API BSI untuk mendapatkan VA
        // $bsiApi = new BsiApiService();
        // $result = $bsiApi->generateVa([
        //     'nama' => $request->nama,
        //     'email' => $request->email,
        //     'nomor_hp' => $request->nomor_hp,
        //     'program_studi' => $request->program_studi,
        //     'fakultas' => $request->fakultas,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        //     'alamat' => $request->alamat,
        //     'kota' => $request->kota,
        //     'provinsi' => $request->provinsi,
        //     'kode_pos' => $request->kode_pos,
        //     'tempat_lahir' => $request->tempat_lahir,
        //     'tanggal_lahir' => $request->tanggal_lahir,
        //     'asal_sekolah' => $request->asal_sekolah,
        //     'jurusan_sekolah' => $request->jurusan_sekolah,
        //     'tahun_lulus' => $request->tahun_lulus,
        //     'nilai_rata2' => $request->nilai_rata2,
        //     'status' => $request->status,
        // ]);

        // Panggil API billing untuk membuat transaksi
        $billingApi = new BillingApi();
        $result = $billingApi->createTransaction([
            'date' => $request->date,
            'amount' => $request->amount,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'va' => $request->va,
            'number' => $request->number,
            'attribute1' => $request->attribute1,
            'attribute2' => $request->attribute2,
            'sequenceNumber' => $request->sequenceNumber,
            'items' => $request->items,
            'attributes' => $request->attributes,
        ]);

        // Simpan data pendaftaran ke database
        $pendaftaran = new Pendaftaran([
            'nama' => $request->name,
            'email' => $request->email,
            'nomer_registrasi' => $result['transactionId'],
            'jumlah_uang' => $request->amount,
            'tanggal_bayar' => $request->date,
            'va' => $request->va, // menggunakan nomor VA dari data Pendaftaran Mahasiswa Baru
        ]);
        $pendaftaran->save();        

        // Kirim data ke BSI API
        $bsiApi = new BsiApiService();
        $response = $bsiApi->sendData([
            'nama' => $request->name,
            'email' => $request->email,
            'nomer_registrasi' => $result['transactionId'],
            'jumlah_uang' => $request->amount,
            'tanggal_bayar' => $request->date,
        ]);

        // Kirim data ke MyApiClient
        $myApiClient = new MyApiClient();
        $myApiClient->sendData([
            'nama' => $request->name,
            'email' => $request->email,
            'nomer_registrasi' => $result['transactionId'],
            'jumlah_uang' => $request->amount,
            'tanggal_bayar' => $request->date,
        ]);

        return response()->json([
            'timestamp' => date('m/d/Y h:i:s A'),
            'code' => '00',
            'message' => 'Pendaftaran berhasil',
        ]);
    }
}    