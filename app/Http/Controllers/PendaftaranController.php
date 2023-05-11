<?php

namespace App\Http\Controllers\API;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftaran = Pendaftaran::all();
        return response()->json($pendaftaran);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'nomer_registrasi' => 'required|unique:pendaftarans',
            'jumlah_uang' => 'required',
            'tanggal_bayar' => 'required|date',
        ]);

        $pendaftaran = Pendaftaran::create($validatedData);

        return response()->json([
            'message' => 'Pendaftaran berhasil disimpan',
            'data' => $pendaftaran
        ]);
    }

    public function show(Pendaftaran $pendaftaran)
    {
        return response()->json($pendaftaran);
    }

    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'jumlah_uang' => 'required',
            'tanggal_bayar' => 'required|date',
        ]);

        $pendaftaran->update($validatedData);

        return response()->json([
            'message' => 'Pendaftaran berhasil diperbarui',
            'data' => $pendaftaran
        ]);
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();

        return response()->json([
            'message' => 'Pendaftaran berhasil dihapus'
        ]);
    }
}
