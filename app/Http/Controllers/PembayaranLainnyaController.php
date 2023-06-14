<?php

namespace App\Http\Controllers;

use PDF;
use GuzzleHttp\Client;
use App\Models\PembayaranLainnya;
use App\Models\Histori;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Services\BsiApiService;
use App\Exports\PembayaranExport;
use App\Imports\pembayaranImport;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use GuzzleHttp\Exception\GuzzleException;

class PembayaranLainnyaController extends Controller
{


    public function index(Request $request)
    {
        $title = 'Log Transaksi';
        return view('pages.LogTransaksi.log_transaksi' , compact('title'));
    }

    public function data(Request $request)
    {
    	$orderBy = 'pembayaran_lainnya.id';
        
        switch($request->input('order.0.column')){
            case "0":
                $orderBy = 'pembayaran_lainnya.id';
                break;
            case "1":
                $orderBy = 'pembayaran_lainnya.name';
                break;
            case "2":
                $orderBy = 'pembayaran_lainnya.email';
                break;
            case "3":
                $orderBy = 'pembayaran_lainnya.amount';
                break;
            case "4":
                $orderBy = 'pembayaran_lainnya.regis_number';
                break;
            case "5":
                $orderBy = 'pembayaran_lainnya.paid';
                break;
            case "6":
                $orderBy = 'pembayaran_lainnya.paid_date';
                break;

        }

        $data = PembayaranLainnya::select([
            'pembayaran_lainnya.*',
        ])->where('id_user', '=', Auth()->user()->id)->where('debug' , '=', 'production');

        // search
        if($request->input('search.value')!=null){
            $data = $data->where(function($q)use($request){
                $q->whereRaw('LOWER(pembayaran_lainnya.name) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran_lainnya.email) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran_lainnya.regis_number) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran_lainnya.amount) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ;
            });
        }

        // //filter tahun berdasarkan prodi
        // if($request->input('prodi')!=null){
        //     $data = $data->where('prodi',$request->prodi);
        // }

        // //filter tahun berdasarkan tahun akademik
        // if($request->input('tahun_akademik')!=null){
        //     $data = $data->where('tahun_akademik',$request->tahun_akademik);
        // }

        //filter berdasarkan status
        if($request->input('openPayment')!=null){
            if($request->input('openPayment')== 1){
                $data = $data->where('openPayment', $request->openPayment);
            }else if($request->input('openPayment')== 0){
                $data = $data->where('openPayment', $request->openPayment);
            }
        }

        // //filter berdasarkan semester
        // if($request->input('semester')!=null){
        //     if($request->input('semester')== 1){
        //         $data = $data->where('semester', $request->semester);
        //     }else if($request->input('semester')== 2){
        //         $data = $data->where('semester', $request->semester);
        //     }else if($request->input('semester')== 3){
        //         $data = $data->where('semester', $request->semester);
        //     }else if($request->input('semester')== 4){
        //         $data = $data->where('semester', $request->semester);
        //     }else if($request->input('semester')== 5){
        //         $data = $data->where('semester', $request->semester);
        //     }else if($request->input('semester')== 6){
        //         $data = $data->where('semester', $request->semester);
        //     }else if($request->input('semester')== 7){
        //         $data = $data->where('semester', $request->semester);
        //     }else if($request->input('semester')== 8){
        //         $data = $data->where('semester', $request->semester);
        //     }
        // }

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

    public function indexShowList(Request $request)
    {
        $jenis_pembayaran = PembayaranLainnya::distinct()->pluck('jenis_pembayaran');
        $title = 'Pembayaran Lainnya';
        return view('pages.pembayaran_lainnya' , compact(['title','jenis_pembayaran']));
    }

    public function dataShowList(Request $request)
    {
    	$orderBy = 'pembayaran_lainnya.name';
        
        switch($request->input('order.0.column')){
            case "1":
                $orderBy = 'pembayaran_lainnya.id';
                break;
            case "2":
                $orderBy = 'pembayaran_lainnya.name';
                break;
            case "3":
                $orderBy = 'pembayaran_lainnya.email';
                break;
            case "4":
                $orderBy = 'pembayaran_lainnya.amount';
                break;
            case "5":
                $orderBy = 'pembayaran_lainnya.regis_number';
                break;
            case "6":
                $orderBy = 'pembayaran_lainnya.paid';
                break;
            case "7":
                $orderBy = 'pembayaran_lainnya.paid_date';
                break;
            default:
                $orderBy = 'pembayaran_lainnya.regis_number';
                break;
        }

            $data = PembayaranLainnya::select([
                'pembayaran_lainnya.*'
            ]);



        // search
        if($request->input('search.value')!=null){
            $data = $data->where(function($q)use($request){
                $q->whereRaw('LOWER(pembayaran_lainnya.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran_lainnya.email) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran_lainnya.regis_number) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran_lainnya.amount) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ;
            });
        }

        //filter tahun berdasarkan prodi
        if($request->input('jenis_pembayaran')!=null){
            $data = $data->where('jenis_pembayaran',$request->jenis_pembayaran);
        }

        // //filter tahun berdasarkan tahun akademik
        // if($request->input('tahun_akademik')!=null){
        //     $data = $data->where('tahun_akademik',$request->tahun_akademik);
        // }

        //filter berdasarkan status
        if($request->input('paid')!=null){
            if($request->input('paid')== 1){
                $data = $data->where('paid', $request->paid);
            }
        }

        // //filter berdasarkan semester
        // if($request->input('semester')!=null){
        //     if($request->input('semester')== 1){
        //         $data = $data->where('semester', $request->semester);
        //     }else if($request->input('semester')== 2){
        //         $data = $data->where('semester', $request->semester);
        //     }else if($request->input('semester')== 3){
        //         $data = $data->where('semester', $request->semester);
        //     }else if($request->input('semester')== 4){
        //         $data = $data->where('semester', $request->semester);
        //     }else if($request->input('semester')== 5){
        //         $data = $data->where('semester', $request->semester);
        //     }else if($request->input('semester')== 6){
        //         $data = $data->where('semester', $request->semester);
        //     }else if($request->input('semester')== 7){
        //         $data = $data->where('semester', $request->semester);
        //     }else if($request->input('semester')== 8){
        //         $data = $data->where('semester', $request->semester);
        //     }
        // }

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

    public function showDetail(Request $request, $id){
        $title = 'detail';
        $data = PembayaranLainnya::select([
            'pembayaran_lainnya.*',
            'histori.method as methode',
            'histori.id as histori_id',
            'histori.request_body',
            'histori.respons',
        ])->join('histori','histori.pembayaran_lainnya_id','=','pembayaran_lainnya.id')->find($id);

        if ($data) {
            // Mengambil data histori dengan id_pembayaran_lainnya yang sama
            $histori = Histori::where('pembayaran_lainnya_id', $data->id)->where('mode' , '=', 'production')->get();

        }else {
            echo "Data pembayaran tidak ditemukan.";
        } 


        return view('pages.LogTransaksi.detailLog_transaksi', compact('title','data', 'histori'));
    }

    public function DataTransaction(Request $request){

        $data = $request->validate([
            'token' => 'required',
        ]);

        $data = PembayaranLainnya::select([
            'pembayaran_lainnya.id as transaction_id',
            'pembayaran_lainnya.name',
            'pembayaran_lainnya.email',
            'pembayaran_lainnya.amount',
            'pembayaran_lainnya.regis_number',
            'pembayaran_lainnya.paid',
            'pembayaran_lainnya.paid_date',
        ])->where('debug' , '=', 'production')->where('id_user','=', $data)->get();

        if (!$data->isEmpty()) {
            return response()->json(

                [
                    'message' => 'Success',
                    'data' => $data,
                ], 200
            );    
        } else {
            return response()->json([
                'message' => 'failed : data tidak ditemukan'
            ], 404);
        }

    }

    public function DataDetailTransaction(Request $request){

        $source = $request->validate([
            'id' => 'required',
            'token' => 'required',
        ]);

        $data = PembayaranLainnya::select([
            'pembayaran_lainnya.id as transaction_id',
            'pembayaran_lainnya.name',
            'pembayaran_lainnya.email',
            'pembayaran_lainnya.amount',
            'pembayaran_lainnya.regis_number',
            'pembayaran_lainnya.paid',
            'pembayaran_lainnya.paid_date',
        ])->where('id_user','=', $source['token'])->where('id','=', $source['id'])->first();


        if ($data) {
            return response()->json([
                'message' => 'Success : data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'message' => 'failed : data tidak ditemukan'
            ], 404);
        }

    }

    public function CetakTransaksiPDF(Request $request, $id){

        $data = Histori::select([
            'histori.id',
            'histori.user_id',
            'pembayaran_lainnya.id as transaction_id',
            'pembayaran_lainnya.name',
            'pembayaran_lainnya.email',
            'pembayaran_lainnya.amount',
            'pembayaran_lainnya.regis_number',
            'pembayaran_lainnya.paid',
            'pembayaran_lainnya.paid_date',
        ])->join('pembayaran_lainnya', 'pembayaran_lainnya.id', '=', 'histori.pembayaran_lainnya_id')->where('mode' , '=', 'production')->find($id);
        return response()->json([
            'data' => $data,
        ]);

        $pdf = PDF::loadView('pdf.invoice_pembayaran_ukt', $data);
        return $pdf->download('pembayaran.pdf');
    }
}
