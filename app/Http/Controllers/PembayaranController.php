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
        $datatahunakademik = Pembayaran::distinct()->pluck('tahun_akademik');
        $dataprodi = Pembayaran::distinct()->pluck('prodi');
        return view('pages.pembayaran' , compact('title','datatahunakademik','dataprodi'));
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

        $datatahun = Pembayaran::distinct()->pluck('tahun_akademik');


        // search
        if($request->input('search.value')!=null){
            $data = $data->where(function($q)use($request){
                $q->whereRaw('LOWER(pembayaran.nim) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran.openPayment) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran.date) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran.prodi) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran.semester) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(kategori_pembayaran.kategori_pembayaran) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ;
            });
        }

        //filter tahun berdasarkan prodi
        if($request->input('prodi')!=null){
            $data = $data->where('prodi',$request->prodi);
        }

        //filter tahun berdasarkan tahun akademik
        if($request->input('tahun_akademik')!=null){
            $data = $data->where('tahun_akademik',$request->tahun_akademik);
        }

        //filter berdasarkan status
        if($request->input('openPayment')!=null){
            if($request->input('openPayment')== 1){
                $data = $data->where('openPayment', $request->openPayment);
            }else if($request->input('openPayment')== 0){
                $data = $data->where('openPayment', $request->openPayment);
            }
        }

        //filter berdasarkan semester
        if($request->input('semester')!=null){
            if($request->input('semester')== 1){
                $data = $data->where('semester', $request->semester);
            }else if($request->input('semester')== 2){
                $data = $data->where('semester', $request->semester);
            }else if($request->input('semester')== 3){
                $data = $data->where('semester', $request->semester);
            }else if($request->input('semester')== 4){
                $data = $data->where('semester', $request->semester);
            }else if($request->input('semester')== 5){
                $data = $data->where('semester', $request->semester);
            }else if($request->input('semester')== 6){
                $data = $data->where('semester', $request->semester);
            }else if($request->input('semester')== 7){
                $data = $data->where('semester', $request->semester);
            }else if($request->input('semester')== 8){
                $data = $data->where('semester', $request->semester);
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
        $file = $request->file('Tagihan');
        Excel::import(new pembayaranImport , $file);
        return redirect()->back();

    }

    public function exportDataTerpilih(Request $request)
    {
        $ids = explode(',', $request->ids);
        return Excel::download(new PembayaranExport($ids), 'Pembayaran-terpilih.xlsx');
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
        
            return view('pdf.invoice_pembayaran_ukt', $data);

        // $pdf = PDF::loadView('pdf.invoice_pembayaran_ukt', $data);
        // return $pdf->download('pembayaran.pdf');
    }

}
