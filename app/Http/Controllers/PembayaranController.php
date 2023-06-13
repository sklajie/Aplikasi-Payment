<?php

namespace App\Http\Controllers;

use PDF;
use TCPDF;
use GuzzleHttp\Client;
use App\Models\Histori;
use App\Models\Pembayaran;
use App\Models\Mahasiswa;
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

use function PHPSTORM_META\map;

class PembayaranController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Data Pembayaran - Belum Dibayar';
        $datatahunakademik = Pembayaran::distinct()->pluck('tahun_akademik');
        $dataprodi = Pembayaran::distinct()->pluck('prodi');
        $datasemester = Pembayaran::distinct()->pluck('semester');
        return view('pages.pembayaran' , compact('title','datatahunakademik','dataprodi','datasemester'));
    }

     public function indexDIbayar(Request $request)
    {
        $title = 'Data Pembayaran - Dibayar';
        $datatahunakademik = Pembayaran::distinct()->pluck('tahun_akademik');
        $dataprodi = Pembayaran::distinct()->pluck('prodi');
        $datasemester = Pembayaran::distinct()->pluck('semester');
        return view('pages.pembayaran_dibayar' , compact('title','datatahunakademik','dataprodi','datasemester'));
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

        return redirect()->back()->with('success', 'Aktivasi VA berhasil dilakukan.');

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

        return redirect()->back()->with('success', 'Update perpanjang masa berlaku VA berhasil dilakukan.');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'va' => 'required|unique',
            'email' => 'required',
            'amount' => 'required',
            'kategori_pembayaran' => 'required',
        ]);

        $pembayaran = new Pembayaran;
        $pembayaran->nama = $request->name;
        $pembayaran->nim = $request->nim;
        $pembayaran->phone = $request->phone;
        $pembayaran->address = $request->address;
        $pembayaran->email = $request->email;
        $pembayaran->amount = $request->amount;
        $pembayaran->va = $request->va;
        $pembayaran->va = $request->va;
        $pembayaran->kategori_pembayaran = $request->kategori_pembayaran;
        $pembayaran->save();

        return redirect()->back()->with('Success', 'Data Berhasil Ditambahkan');
    }



    public function dataDIbayar(Request $request)
    {
    	// $orderBy = 'pembayaran.nim';
        
        switch($request->input('order.0.column')){
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
                $orderBy = 'pembayaran.status';
                break;
            default:
                $orderBy = 'pembayaran.nim';
                break;
        }

        $data = Pembayaran::select([
            'pembayaran.*',
        ])->orderBy($orderBy, $request->input('order.0.dir'))->where('status','=', 1);

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
                ->orWhereRaw('LOWER(pembayaran.kategori_pembayaran) like ? ',['%'.strtolower($request->input('search.value')).'%'])
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
            $data = $data->where('semester',$request->semester);
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
                $orderBy = 'pembayaran.status';
                break;
            default:
                $orderBy = 'pembayaran.nim';
                break;
        }

        $data = Pembayaran::select([
            'pembayaran.*',
        ])->orderBy($orderBy, $request->input('order.0.dir'))->where('status','=', 0);

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
                ->orWhereRaw('LOWER(pembayaran.kategori_pembayaran) like ? ',['%'.strtolower($request->input('search.value')).'%'])
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
        //filter berdasarkan semester
        if($request->input('semester')!=null){
            $data = $data->where('semester',$request->semester);
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

        $invoice = Pembayaran::find($id);
        
            // return view('pdf.invoice_pembayaran_ukt', $data , compact('formattedTime'));


        $pdf = PDF::loadView('pdf.invoice', [$invoice]);
        return $pdf->download('pembayaran.pdf');

    // $filename = 'pembayaran.pdf';

    // $view = view('pdf.invoice_pembayaran_ukt', $data)->render();
    
    // $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
    // $pdf->SetTitle('Hello World');
    // $pdf->AddPage();
    // $pdf->writeHTML($view);
    
    // $pdf->Output(public_path($filename), 'F');
    
    // return response()->download(public_path($filename));
    

    }  

    public function StoreDataPembayaran(Request $request)
    {
        $parameterMahasiswa = [
            'key' => 'ac43ce6a-8268-4887-aa50-2435d27de055',
            'debug' => 'false',
            'datatable' => 'false',
            'per_page' => 30
        ];

        $responsemhs = Http::post('http://api-gateway.polindra.ac.id/api/mahasiswa',$parameterMahasiswa);

        if ($responsemhs->successful()) {

            $data_mahasiswa = $responsemhs['result']['data'];

            $tahunsekarang = date('Y');
            $tahundepan = $tahunsekarang+1;
            $tahunakademik = $tahunsekarang.'/'.$tahundepan;

        foreach($data_mahasiswa as $items){
                    // Periksa apakah data sudah ada dalam database
                $semester = substr($items['semester_label'], 9 );
                $existingData = Mahasiswa::where('nim_mahasiswa', $items['mahasiswa_nim'])->first();
    
                if (!$existingData) {
                    // Jika data tidak ada dalam database, simpan data baru
                    Mahasiswa::create([
                        'nama_mahasiswa' => $items['mahasiswa_nama'],
                        'nim_mahasiswa' => $items['mahasiswa_nim'],
                        'semester_mahasiswa' => $semester,
                        'email_mahasiswa' => $items['user_mail'],
                        'address_mahasiswa' => $items['mahasiswa_alamat'],
                        'phone_mahasiswa' => $items['mahasiswa_handphone'],
                        'tahun_akademik_mahasiswa' => $tahunakademik,
                        'prodi_mahasiswa' => $items['nama_prodi'],
                    ]);
                }else{
                    continue;
                }
            }
        }

        $dataMHS = Mahasiswa::all();

        foreach ($dataMHS as $data) {

            // echo $data->nim_mahasiswa;

            $parameterukt = [
                'key' => 'ac43ce6a-8268-4887-aa50-2435d27de055',
                'debug' => 'false',
                'datatable' => 'false',
                'nim' => $data->nim_mahasiswa
            ];

            $responseUKT = Http::post('http://api-gateway.polindra.ac.id/api/mahasiswa/ukt',$parameterukt);

            $data_ukt= $responseUKT['result']['data'];

            foreach($data_ukt as $data_invoice){
                

                $semester = substr($data_invoice['semester_label'], 9 );
                $tahun_akademik = substr($data_invoice['tahun_akademik'], 6 );

                $tahunsekarang = date('Y');

                $status_value = ($data_invoice['bayar_status'] == "lunas") ? 1 : 0;

                $no_va =  $data_invoice['mahasiswa_nim'].$semester;
                

                $existingDataUkt = Pembayaran::where('va', $no_va)->first();
    
                if (!$existingDataUkt) {
                    // Jika data tidak ada dalam database, simpan data baru
                    Pembayaran::create([
                        'kategori_pembayaran' => 'Uang Kuliah Tahunan',
                        'nama' => $data->nama_mahasiswa,
                        'nim' => $data->nim_mahasiswa,
                        'semester' => $semester,
                        'email' => $data->email_mahasiswa,
                        'address' => $data->address_mahasiswa,
                        'phone' => $data->phone_mahasiswa,
                        'tahun_akademik' => $tahun_akademik,
                        'va' => $no_va,
                        'prodi' => $data->prodi_mahasiswa,
                        'status' => $status_value,
                        'amount' => $data_invoice['bayar_nilai'],
                        'date' => $data_invoice['bayar_tanggal']
                    ]);

                }else{
                    continue;
                }
            }

        }

        return redirect()->back();

    }

    public function invoice($id){
        $title = 'Invoice';
        $invoice = Pembayaran::find($id);
        return view('pdf.invoice', compact('title','invoice'));

    }

}
