<?php

namespace App\Http\Controllers;

use PDF;
use TCPDF;
use GuzzleHttp\Client;
use App\Models\Histori;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Libraries\PdfGenerator;
use App\Services\BsiApiService;
use App\Exports\PembayaranExport;
use App\Imports\pembayaranImport;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use GuzzleHttp\Exception\GuzzleException;

class PembayaranController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Data Pembayaran - Belum Dibayar';
        $datatahunakademik = Pembayaran::distinct()->pluck('tahun_akademik');
        $dataprodi = Pembayaran::distinct()->pluck('prodi');
        return view('pages.pembayaran' , compact('title','datatahunakademik','dataprodi'));
    }

     public function indexDIbayar(Request $request)
    {
        $title = 'Data Pembayaran - Dibayar';
        $datatahunakademik = Pembayaran::distinct()->pluck('tahun_akademik');
        $dataprodi = Pembayaran::distinct()->pluck('prodi');
        return view('pages.pembayaran_dibayar' , compact('title','datatahunakademik','dataprodi'));
    }
    
    public function aktivasiVA(Request $request){

        $ids = explode(',', $request->ids);
        $active_date = $request->activeDate;
        $inactive_date = $request->inactiveDate;

        $pembayarans = Pembayaran::whereIn('id', $ids)->get();

        foreach ($pembayarans as $item) {
            $pembayaran = Pembayaran::find($item->id);

            if (!$pembayaran) {
                // Objek pembayaran tidak ditemukan, lakukan penanganan kesalahan atau lanjutkan ke iterasi berikutnya
                continue;
            }

            $pembayaran->activeDate = $active_date;
            $pembayaran->inactiveDate = $inactive_date;
            $pembayaran->status = 0;
            $pembayaran->save();
        }

        $pembayarans = Pembayaran::whereIn('pembayaran.id', $ids)->join('item_pembayaran','item_pembayaran.id','=','pembayaran.item_pembayaran_id')->get();

        $data = $pembayarans->map(function ($pembayaran) {

            return [

                'date' => date("Y-m-d"),
                'amount'=>  $pembayaran->amount,
                'name' => $pembayaran->nama,
                'email'=> $pembayaran->email,
                'address'=>$pembayaran->address,
                'va'=>(int) $pembayaran->va,
                'phone'=>$pembayaran->phone,
                'activeDate'=> $pembayaran->activeDate,
                'inactiveDate'=> $pembayaran->inactiveDate,
                'items' => [
                    [
                        'description'=>'Pembayaran UKT',
                        'unitPrice' =>  $pembayaran->amount,
                        'qty'=> 1,
                        'amount'=>  $pembayaran->amount
                    ]
                ],
                'attributes' => []
            ];
        });


        foreach($data as $datas){

            $response = Http::asForm()->post('https://account.makaramas.com/auth/realms/bpi-dev/protocol/openid-connect/token', [
                'grant_type' => 'password',
                'client_id' => 'BPI3764',
                'client_secret' => 'cJ33C8xjyVbxTNTKCnqgrxoZaCsnvRep',
                'username' => '3764',
                'password' => '3764',
            ]);
            
            $accessToken = $response['access_token'];

            $responseapi = Http::withHeaders([
                'Authorization' => 'Bearer '. $accessToken,
                ])->post('https://billing-bpi-dev.maja.id/api/v2/register', $datas);

                        // Inisialisasi array kosong
            
            $save_number = Pembayaran::where('va',$datas['va'])->first();
            $save_number->invoiceNumber = $responseapi->json('data.number');;
            $save_number->save();
        }

        return redirect()->route('pembayaran.index')->with('success', 'Aktivasi VA berhasil dilakukan.');

    }

    public function updateInvoice(Request $request)
    {

        // Mengisi data dari tabel pembayaran_lainnya ke dalam variabel
        $ids = explode(',', $request->ids);
        $active_date = $request->activeDate;
        $inactive_date = $request->inactiveDate;

        $pembayarans = Pembayaran::whereIn('id', $ids)->get();


        foreach ($pembayarans as $item) {
            $pembayaran = Pembayaran::find($item->id);

            if (!$pembayaran) {
                // Objek pembayaran tidak ditemukan, lakukan penanganan kesalahan atau lanjutkan ke iterasi berikutnya
                continue;
            }

            $pembayaran->activeDate = $active_date;
            $pembayaran->inactiveDate = $inactive_date;
            $pembayaran->status = 0;
            $pembayaran->save();
        }

        $pembayarans = Pembayaran::whereIn('pembayaran.id', $ids)->join('item_pembayaran','item_pembayaran.id','=','pembayaran.item_pembayaran_id')->get();

        $data = $pembayarans->map(function ($pembayaran) {

            return [

                'date' => date("Y-m-d"),
                'amount'=>  $pembayaran->amount,
                'name' => $pembayaran->nama,
                'email'=> $pembayaran->email,
                'address'=>$pembayaran->address,
                'va'=>$pembayaran->va,
                'phone'=>$pembayaran->phone,
                'activeDate'=> $pembayaran->activeDate,
                'inactiveDate'=> $pembayaran->inactiveDate,
                'items' => [
                    [
                        'description'=>'Pembayaran UKT',
                        'unitPrice' =>  $pembayaran->unitPrice,
                        'qty'=>  $pembayaran->qty,
                        'amount'=>  $pembayaran->amount
                    ]
                ],
                'attributes' => [],
                'number' => $pembayaran->invoiceNumber,
            ];
        });


        foreach($data as $datas){

            $response = Http::asForm()->post('https://account.makaramas.com/auth/realms/bpi-dev/protocol/openid-connect/token', [
                'grant_type' => 'password',
                'client_id' => 'BPI3764',
                'client_secret' => 'cJ33C8xjyVbxTNTKCnqgrxoZaCsnvRep',
                'username' => '3764',
                'password' => '3764',
            ]);
            
            $accessToken = $response['access_token'];

            $responseapi = Http::withHeaders([
                'Authorization' => 'Bearer '. $accessToken,
                ])->post('https://billing-bpi-dev.maja.id/api/v2/update/' . $datas['number'], $datas);

            dd($responseapi->json());


            // $method = $request->method();
            // $endpointapi = $request->fullUrl();
            // $endpointAPI = strval($endpointapi);
    
            // if ($responseapi->successful()) {
            //     // Jika permintaan sukses, perbarui data respons dan waktu update di tabel histori
            //     $histori = new Histori();
            //     $histori->pembayaran_lainnya_id = $datas->id;
            //     $histori->method = $method;
            //     $histori->endpoint = $endpointAPI;
            //     $histori->mode = 'sandbox';
            //     $histori->request_body = json_encode($data);
            //     $histori->respons = json_encode($responseapi->json());
            //     $histori->updated_at = now();
            //     // set user_id jika ada
    
            //     $histori->save();
            // } else {
            //     // Jika permintaan gagal, berikan respons error atau lakukan tindakan yang sesuai
            //     return response()->json([
            //         'timestamp' => date('m/d/Y, h:i:s A'),
            //         'success' => false,
            //         'message' => 'Gagal meng-update invoice',
            //     ], 500);
            // }
    
            // Berikan respons sukses
            // return response()->json([
            //     'timestamp' => date('m/d/Y, h:i:s A'),
            //     'success' => true,
            //     'message' => 'Invoice berhasil diupdate',
            // ]);
        }

        return redirect()->route('pembayaran.index')->with('success', 'Update perpanjang masa berlaku VA berhasil dilakukan.');
    }


    public function dataDIbayar(Request $request)
    {
    	// $orderBy = 'pembayaran.nim';
        
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
                $orderBy = 'pembayaran.status';
                break;
            default:
                $orderBy = 'pembayaran.nim';
                break;
        }

        $data = Pembayaran::select([
            'pembayaran.*',
            'kategori_pembayaran.kategori_pembayaran as nama_kategori'
        ])->orderBy($orderBy, $request->input('order.0.dir'))
        ->join('kategori_pembayaran','kategori_pembayaran.id','=','pembayaran.kategori_pembayaran_id')
        ->where('status','=', 1);

        $datatahun = Pembayaran::distinct()->pluck('tahun_akademik');


        // search
        if($request->input('search.value')!=null){
            $data = $data->where(function($q)use($request){
                $q->whereRaw('LOWER(pembayaran.nim) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran.status) like ? ',['%'.strtolower($request->input('search.value')).'%'])
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
        if($request->input('status')!=null){
            if($request->input('status')== 1){
                $data = $data->where('status', $request->status);
            }else if($request->input('status')== 0){
                $data = $data->where('status', $request->status);
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

    public function data(Request $request)
    {
    	// $orderBy = 'pembayaran.nim';
        
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
                $orderBy = 'pembayaran.status';
                break;
            default:
                $orderBy = 'pembayaran.nim';
                break;
        }

        $data = Pembayaran::select([
            'pembayaran.*',
            'kategori_pembayaran.kategori_pembayaran as nama_kategori'
        ])->orderBy($orderBy, $request->input('order.0.dir'))
        ->join('kategori_pembayaran','kategori_pembayaran.id','=','pembayaran.kategori_pembayaran_id')
        ->where('status','=', 0);

        $datatahun = Pembayaran::distinct()->pluck('tahun_akademik');


        // search
        if($request->input('search.value')!=null){
            $data = $data->where(function($q)use($request){
                $q->whereRaw('LOWER(pembayaran.nim) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(pembayaran.status) like ? ',['%'.strtolower($request->input('search.value')).'%'])
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
        if($request->input('status')!=null){
            if($request->input('status')== 1){
                $data = $data->where('status', $request->status);
            }else if($request->input('status')== 0){
                $data = $data->where('status', $request->status);
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
     * 
     */

        $currentTime = Carbon::now();
        setlocale(LC_TIME, 'id_ID');
        $formattedTime = $currentTime->isoFormat('dddd, D MMMM YYYY');

        $data['pembayaran'] = Pembayaran::select([
        'pembayaran.*',
        'kategori_pembayaran.kategori_pembayaran as nama_kategori'
        ])->join('kategori_pembayaran','kategori_pembayaran.id','=','pembayaran.kategori_pembayaran_id')->find($id);
        
            return view('pdf.invoice_pembayaran_ukt', $data , compact('formattedTime'));


        // $pdf = PDF::loadView('pdf.invoice_pembayaran_ukt', $data);
        // return $pdf->download('pembayaran.pdf');

    // $filename = 'pembayaran.pdf';

    // $view = view('pdf.invoice_pembayaran_ukt', $data)->render();
    
    // $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
    // $pdf->SetTitle('Hello World');
    // $pdf->AddPage();
    // $pdf->writeHTML($view);
    
    // $pdf->Output(public_path($filename), 'F');
    
    // return response()->download(public_path($filename));
    

    }

}
