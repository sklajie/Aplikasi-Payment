<?php

namespace App\Http\Controllers;

use PDF;
use GuzzleHttp\Client;
use App\Models\PembayaranLainnya;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Services\BsiApiService;
use App\Exports\PembayaranExport;
use App\Imports\pembayaranImport;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use GuzzleHttp\Exception\GuzzleException;

class PembayaranLainnyaController extends Controller
{

    protected $bsiApiService;

    public function __construct(BsiApiService $bsiApiService)
    {
        $this->bsiApiService = $bsiApiService;
    }


    public function index(Request $request)
    {
        $title = 'Log Transaksi';
        return view('pages.log_transaksi' , compact('title'));
    }

    public function data(Request $request)
    {
    	$orderBy = 'pembayaran_lainnya.regis_number';
        
        switch($request->input('order.0.column')){
            case "1":
                $orderBy = 'pembayaran_lainnya.id';
                break;
            case "2":
                $orderBy = 'pembayaran_lainnya.nama';
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
                $orderBy = 'pembayaran_lainnya.paidDate';
                break;
            default:
                $orderBy = 'pembayaran_lainnya.regis_number';
                break;
        }

        $data = PembayaranLainnya::select([
            'pembayaran_lainnya.*'
        ])->orderBy($orderBy, $request->input('order.0.dir'));



        // // search
        // if($request->input('search.value')!=null){
        //     $data = $data->where(function($q)use($request){
        //         $q->whereRaw('LOWER(pembayaran_lainnya.nim) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(pembayaran_lainnya.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(pembayaran_lainnya.openPayment) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(pembayaran_lainnya.date) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(pembayaran_lainnya.prodi) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(pembayaran_lainnya.semester) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(kategori_pembayaran_lainnya.kategori_pembayaran_lainnya) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ;
        //     });
        // }

        // //filter tahun berdasarkan prodi
        // if($request->input('prodi')!=null){
        //     $data = $data->where('prodi',$request->prodi);
        // }

        // //filter tahun berdasarkan tahun akademik
        // if($request->input('tahun_akademik')!=null){
        //     $data = $data->where('tahun_akademik',$request->tahun_akademik);
        // }

        // //filter berdasarkan status
        // if($request->input('openPayment')!=null){
        //     if($request->input('openPayment')== 1){
        //         $data = $data->where('openPayment', $request->openPayment);
        //     }else if($request->input('openPayment')== 0){
        //         $data = $data->where('openPayment', $request->openPayment);
        //     }
        // }

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

    // public function importDataMahasiswa(Request $request)
    // {
    //     $file = $request->file('Tagihan');
    //     Excel::import(new pembayaranImport , $file);
    //     return redirect()->back();

    // }

    // public function exportDataTerpilih(Request $request)
    // {
    //     $ids = explode(',', $request->ids);
    //     return Excel::download(new PembayaranExport($ids), 'Pembayaran-terpilih.xlsx');
    // }

    // public function exportData(Request $request)
    // {
    //     return Excel::download(new PembayaranExport, 'Pembayaran.xlsx');
    // }

    // public function downloadPdf(Request $request, $id){

    // /**
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    //     $data['pembayaran'] = Pembayaran::select([
    //     'pembayaran.*',
    //     'kategori_pembayaran.kategori_pembayaran as nama_kategori'
    //     ])->join('kategori_pembayaran','kategori_pembayaran.id','=','pembayaran.kategori_pembayaran_id')->find($id);
        
    //         return view('pdf.invoice_pembayaran_ukt', $data);

    //     // $pdf = PDF::loadView('pdf.invoice_pembayaran_ukt', $data);
    //     // return $pdf->download('pembayaran.pdf');
    // }

}
