<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Imports\KaryawanImport;
use App\Exports\KaryawanExport;
use App\Exports\TesExport;
use Illuminate\Support\Facades\Http;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data Pembayaran';
        return view('pages.pembayaran' , compact('title'));
    }

    public function aktifasi(Request $request){

        $data = [
            ['name' => $request->names, 'email' => 'johndoe@example.com', 'password' => 'password123'],
        ];
        
        foreach ($data as $pembayaran) {
            $response =Http::withHeaders('')->post('https://billing-bpi-dev.maja.id/api/v2/invoice', $pembayaran);
        }
        
    }

    public function data(Request $request)
    {
    	$orderBy = 'pembayaran.nim';
        switch($request->input('order.1.column')){
            case "1":
                $orderBy = 'pembayaran.id';
                break;
            case "2":
                $orderBy = 'pembayaran.kategori_pembayaran';
                break;
            case "3":
                $orderBy = 'pembayaran.nama';
                break;
            case "4":
                $orderBy = 'pembayaran.nim';
                break;
            case "5":
                $orderBy = 'pembayaran.email';
                break;
            case "6":
                $orderBy = 'pembayaran.phone';
                break;
            case "7":
                $orderBy = 'pembayaran.address';
                break;
            case "8":
                $orderBy = 'pembayaran.semester';
                break;
            case "9":
                $orderBy = 'pembayaran.tahun_akademik';
                break;
            case "10":
                $orderBy = 'pembayaran.prodi';
                break;
            case "11":
                $orderBy = 'pembayaran.va';
                break;
            case "12":
                $orderBy = 'pembayaran.date';
                break;
            case "13":
                $orderBy = 'pembayaran.openPayment';
                break;
        }

        $data = Pembayaran::select([
            'pembayaran.*'
        ]);
        // ->where('status')
        // ->join('organisasi','organisasi.id','=','karyawan.organisasi_id')
        // ;

        // if($request->input('search.value')!=null){
        //     $data = $data->where(function($q)use($request){
        //         $q->whereRaw('LOWER(karyawan.nik) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(karyawan.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(karyawan.nomor_ktp) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(karyawan.telp) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(karyawan.status) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(karyawan.status) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(organisasi.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ;
        //     });
        // }

        // if($request->input('organisasi')!=null){
        //     $data = $data->where('organisasi_id',$request->organisasi);
        // }
        // if($request->input('bpjs_kesehatan')!=null){
        //     if($request->input('bpjs_kesehatan')==1){
        //         $data = $data->whereNotNull('nomor_bpjs_kesehatan');
        //     }else if($request->input('bpjs_kesehatan')==0){
        //         $data = $data->whereNull('nomor_bpjs_kesehatan');
        //     }
        // }
        // if($request->input('bpjs_ketenagakerjaan')!=null){
        //     if($request->input('bpjs_ketenagakerjaan')==1){
        //         $data = $data->whereNotNull('nomor_bpjs_ketenagakerjaan');
        //     }else if($request->input('bpjs_ketenagakerjaan')==0){
        //         $data = $data->whereNull('nomor_bpjs_ketenagakerjaan');
        //     }
        // }

        $recordsFiltered = $data->get()->count();
        if($request->input('length')!=-1) $data = $data->skip($request->input('start'))->take($request->input('length'));
        return response()->json([
            'draw'=>$request->input('draw'),
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$data
        ]);
    }

    // public function create(Request $request)
    // {
    //     #AMBIL SEMUA REQUEST KECUALI TOKEN DAN FOTO. SOALNYA FOTO = FILE BUKAN TEKS
    //     $will_insert = $request->except(['foto','_token']);

    //     #JIKA USER UPLOAD FOTO
    //     if($request->hasFile('foto')){
    //         $extension = $request->file('foto')->getClientOriginalExtension();#AMBIL EXTENSION
    //         #STORE KE SOTRAGE
    //         $path_foto = $request->file('foto')->storeAs(
    //             'foto', $request->input('nik').'.'.$extension
    //         );
    //         #SET KE VARIABLE YANG AKAN DI INSERT KE KARYAWAN TABLE
    //         $will_insert['foto'] = $path_foto;
    //     }

    //     Pembayaran::create($will_insert);
    //     // return redirect('/Pembayaran/aktif');
    //     return response()->json(true);
    // }

    // public function edit(Request $request)
    // {
    //     $will_update = $request->except(['foto','_token','_method']);
    //     #JIKA USER UPLOAD FOTO
    //     if($request->hasFile('foto')){
    //         $extension = $request->file('foto')->getClientOriginalExtension();#AMBIL EXTENSION
    //         #STORE KE SOTRAGE
    //         $path_foto = $request->file('foto')->storeAs(
    //             'foto', $request->input('nik').'.'.$extension
    //         );
    //         #SET KE VARIABLE YANG AKAN DI INSERT KE Pembayaran TABLE
    //         $will_update['foto'] = $path_foto;
    //     }
    //     Pembayaran::where('id',$request->input('id'))->update($will_update);

    //     return response()->json(true);
    // }

    // public function updateStatus(Request $request)
    // {
    //     $karyawan = Pembayaran::find($request->input('id'));
    //     $karyawan->status = $request->status;
    //     $karyawan->save();
    //     return response()->json(true);
    // }

    // public function importDataKaryawan(Request $request)
    // {
    //     $file = $request->file('excel-karyawan');
    //     Excel::import(new KaryawanImport,$file);
    //     return redirect()->back();

    // }

    // public function exportData(Request $request)
    // {
    //     return Excel::download(new KaryawanExport, 'karyawan.xlsx');
    // }

    // public function exportDataTerpilih(Request $request)
    // {
    //     $ids = explode(',', $request->ids);
    //     return Excel::download(new KaryawanExport($ids), 'karyawan.xlsx');
    // }

    // public function tesExport(Request $request)
    // {
    //     return Excel::download(new TesExport, 'tes.xlsx');
    // }

    // public function nonAktifkanBanyak(Request $request)
    // {
    //     Pembayaran::whereIn('id',$request->ids)->update(['status'=>'non aktif']);
    //     return response()->json(true);
    // }

    // public function aktifkanBanyak(Request $request)
    // {
    //     Pembayaran::whereIn('id',$request->ids)->update(['status'=>'aktif']);
    //     return response()->json(true);
    // }    

    // public function downloadPdf(Request $request, $id){
    //     $data['karyawan'] = Pembayaran::select([
    //                 'karyawan.*',
    //                 'organisasi.nama as nama_organisasi'
    //     ])->join('organisasi','organisasi.id','=','karyawan.organisasi_id')->find($id);

    //     $pdf = PDF::loadView('pdf.karyawan', $data);
    //     return $pdf->stream('karyawan.pdf');
    // }

    // public function getFoto(Request $request,$id)
    // {
    //     $karyawan = Pembayaran::whereNotNull('foto')->find($id);
    //     if($karyawan == null) abort(404);
    //     $path = storage_path('app/'.$karyawan->foto);
    //     // $file = \Storage::get($path);
    //     // $type = \Storage::mimeType($path);
    //     // $response = \Response::make($file, 200)->header("Content-Type", $type);
    //     // return $response;
    //     return response()->file($path);
    // }

}
