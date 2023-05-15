<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriPembayaran;

class KategoriPembayaranController extends Controller
{
    public function index()
    {
        $title = 'Kategori Pembayaran';
        return view('pages.kategori_pembayaran', compact('level','title'))->with([
            'kategori_pembayaran' => KategoriPembayaran::all(),
        ]);

    }

    public function create()
    {
        $title = 'Kategori Pembayaran';
        return view('pages.tambah_kategori_pembayaran', compact('title'))->with([
            'kategori_pembayaran' => KategoriPembayaran::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_pembayaran' => 'required',
        ]);

        $user = new KategoriPembayaran();
        $user->kategori_pembayaran = $request->kategori_pembayaran;
        $user->save();

        return to_route('kategori_pembayaran.index')->with('Success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $title = 'Kategori Pembayaran';
        return view('pages.edit_kategori_pembayaran', compact('title'))->with([
            'kategori_pembayaran' => KategoriPembayaran::find($id),
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_pembayaran' => 'required'
        ]);

        $user = KategoriPembayaran::find($id);
        $user->kategori_pembayaran = $request->kategori_pembayaran;
        $user->save();

        return to_route('kategori_pembayaran.index')->with('Success.', 'Data Berhasil Diedit ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $user = KategoriPembayaran::find($id);
        $user->delete();


        return back()->with('Success','Berhasil Hapus Data');
    }

}
