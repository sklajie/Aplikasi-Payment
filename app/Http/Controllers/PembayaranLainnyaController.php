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

    protected $bsiApiService;

    public function __construct(BsiApiService $bsiApiService)
    {
        $this->bsiApiService = $bsiApiService;
    }


    public function index(Request $request)
    {
        $title = 'Log Transaksi';
        return view('pages.LogTransaksi.log_transaksi' , compact('title'));
    }

    public function data(Request $request)
    {
    	$orderBy = 'pembayaran_lainnya.id';
        
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
            'pembayaran_lainnya.*',
        ]);





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

    public function showDetail(Request $request, $id){
        $title = 'detail';
        $data = PembayaranLainnya::select([
            'pembayaran_lainnya.*',
            'histori.method as methode',
            'histori.id as histori_id',
        ])->join('histori','histori.pembayaran_lainnya_id','=','pembayaran_lainnya.id')->find($id);

        if ($data) {
            // Mengambil data histori dengan id_pembayaran_lainnya yang sama
            $histori = Histori::where('pembayaran_lainnya_id', $data->id)->get();

        }else {
            echo "Data pembayaran tidak ditemukan.";
        } 


        return view('pages.LogTransaksi.detailLog_transaksi', compact('title','data', 'histori'));
    }

    public function PaymentNotification(Request $request){

        $va = $request->va;
        $amount = $request->amount;
        $paid = $request->paid;
        $paidDate = $request->paidDate;

        $pembayaran_lainnya = PembayaranLainnya::whereIn('pembayaran_lainnya.va', $va)->get();

        $pembayaran_lainnya->paid = $paid;
        $pembayaran_lainnya->paidDate = $paidDate;
        $pembayaran_lainnya->save();


        

        // try {
        //     $data = $request->validate([
        //         'name' => 'required',
        //         'email' => 'required|email',
        //         'va' => 'required',
        //         'user_id' => 'required',
        //         'amount' => 'required|numeric',
        //         'date' => 'required|date',
        //         // 'attribute1' => 'nullable',
        //         // 'attribute2' => 'nullable',
        //         'items' => 'required|array',
        //         'items.*.description' => 'required',
        //         'items.*.unitPrice' => 'required|numeric',
        //         'items.*.qty' => 'required|integer',
        //         'items.*.amount' => 'required|numeric',
        //         'attributes' => 'nullable|array',
        //     ]);
            
        //     DB::beginTransaction();
            
        // Simpan data histori request ke dalam tabel HistoriRequest
        $historiRequest = HistoriRequest::create([
            'va' => $data['name'],
            'amount' => $data['email'],
            'regis_number' => $data['regis_number'],
            'amount' => (int)$data['amount'],
            'user_id' => '133759c4-c0d0-4396-bfa4-fe4851c9c303',
            'created_date' => now(), // Tanggal dibuat (sekarang)
        ]);
        
        // Buat data untuk dikirim ke Bank BSI
        $requestData = [
            'date' => date('Y-m-d'), 
            'amount' => (int)$data['amount'],
            'va' => $data['regis_number'],
            'name' => $data['name'],
            'email' => $data['email'],
            'items' => [
                [
                    'description'=>'Pembayaran PMB',
                    'unitPrice' => (int)$data['amount'],
                    'qty'=> 1,
                    'amount'=> (int)$data['amount']
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
    
        // Simpan data histori respons ke dalam tabel HistoriRespons
        $historiRespons = HistoriRespons::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'regis_number' => $data['regis_number'],
            'amount' => $data['amount'],
            'created_date' => date('Y-m-d'),
            'respons' => json_encode($responseApi->json()),
        ]);

        //     // Periksa apakah data histori request berhasil disimpan
        //     if ($historiRequest) {
        //         // Periksa status respons dari Bank BSI
        //         if ($response->successful()) {
        //             // Simpan data respons ke tabel HistoriRespons
        //             $historiRespons->save();
    
        //             // Hubungkan data histori respons dengan histori request
        //             $historiRequest->historiRespons()->save($historiRespons);
    
        //             DB::commit();
    
        //             return response()->json([
        //                 'success' => true,
        //                 'message' => 'Data histori request berhasil disimpan dan permintaan ke Bank BSI berhasil dikirim',
        //                 'data' => $historiRequest,
        //             ], 201); // Gunakan status HTTP 201 Created
        //         } else {
        //             DB::rollback();
    
        //             return response()->json([
        //                 'success' => false,
        //                 'message' => 'Data histori request berhasil disimpan tetapi terjadi kesalahan saat mengirim permintaan ke Bank BSI',
        //             ], 500); // Gunakan status HTTP 500 Internal Server Error
        //         }
        //     } else {
        //         DB::rollback();
    
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'Data histori request gagal disimpan',
        //         ], 400); // Gunakan status HTTP 400 Bad Request
        //     }
        // } catch (\Exception $e) {
        //     DB::rollback();
    
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Terjadi kesalahan saat menyimpan data histori request atau mengirim permintaan ke Bank BSI',
        //         'error' => $e->getMessage(),
        //     ], 500);
        // }
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
