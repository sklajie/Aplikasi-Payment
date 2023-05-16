<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Imports\pembayaranImport;
use App\Exports\PembayaranExport;
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
            ['name' => $request->names, 'email' => 'johndoe@example.com', '' => 'password123'],
        ];
        
        foreach ($data as $pembayaran) {
            $response =Http::withHeaders([
                'ClientID' => 'BPI3764',
                'SecretKey' => 'cJ33C8xjyVbxTNTKCnqgrxoZaCsnvRep',
                'username' => '3764',
                'password' => '3764' 
            ])->post('https://billing-bpi-dev.maja.id/api/v2/invoice', $pembayaran);
        }
        
    }

    public function data(Request $request)
    {
    	$orderBy = 'pembayaran.nim';
        switch($request->input('order.0.column')){
            case "1":
                $orderBy = 'pembayaran.id';
                break;
            case "2":
                $orderBy = 'pembayaran.kategori_pembayaran_id';
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
            'pembayaran.*',
            'kategori_pembayaran.kategori_pembayaran as nama_kategori'
        ])->join('kategori_pembayaran','kategori_pembayaran.id','=','pembayaran.kategori_pembayaran_id');

        //filter berdasarkan status
        if($request->input('status')!=null){
            if($request->input('status')==1){
                $data = $data->whereNotNull('status');
            }else if($request->input('status')==0){
                $data = $data->whereNull('status');
            }
        }

        $recordsFiltered = $data->get()->count();
        if($request->input('length')!=-1) $data = $data->skip($request->input('start'))->take($request->input('length'));
        $data = $data->orderBy($orderBy,$request->input('order.0.dir'))->get();
        $recordsTotal = $data->count();
        return response()->json([
            'draw'=>$request->input('draw'),
            'recordsTotal'=>$recordsTotal,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$data
        ]);
    }

    public function importDataMahasiswa(Request $request)
    {
        $file = $request->file('excel-karyawan');
        Excel::import(new pembayaranImport, $file);
        return redirect()->back();

    }

    public function exportData(Request $request)
    {
        return Excel::download(new PembayaranExport, 'Pembayaran.xlsx');
    }

    public function downloadPdf(Request $request, $id){

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        $data['pembayaran'] = Pembayaran::select([
        'pembayaran.*',
        'kategori_pembayaran.kategori_pembayaran as nama_kategori'
        ])->join('kategori_pembayaran','kategori_pembayaran.id','=','pembayaran.kategori_pembayaran_id')->find($id);
        
        $pdf = PDF::loadView('pdf.invoice_pembayaran_ukt', $data);
        return $pdf->download('pembayaran.pdf');
    }

}
