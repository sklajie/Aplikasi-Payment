<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Imports\pembayaranImport;
use App\Exports\PembayaranExport;
use Illuminate\Support\Facades\Http;
use App\Services\BsiApiService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PembayaranController extends Controller
{

    protected $bsiApiService;

    public function __construct(BsiApiService $bsiApiService)
    {
        $this->bsiApiService = $bsiApiService;
    }


    public function index(Request $request)
    {
        $title = 'Data Pembayaran';
        $datatahunakademik = Pembayaran::distinct()->pluck('tahun_akademik');
        $dataprodi = Pembayaran::distinct()->pluck('prodi');
        return view('pages.pembayaran' , compact('title','datatahunakademik','dataprodi'));
    }

    public function getToken()
    {
        $client = new Client();

        try {
            $response = $client->post('https://account.makaramas.com/auth/realms/bpi-dev/protocol/openid-connect/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => 'BPI3764',
                    'client_secret' => 'cJ33C8xjyVbxTNTKCnqgrxoZaCsnvRep',
                    'username' => '3764',
                    'password' => '3764',
                ],
            ]);

            $responseData = json_decode($response->getBody(), true);

            return dd($responseData['access_token']);

            
        } catch (GuzzleException $e) {
            // Handle exception
            return null;
        }
    }

    

    public function aktivasiVA(Request $request){

        // $ids = explode(',', $request->ids);
        // $active_date = $request->activeDate;
        // $inactive_date = $request->inactiveDate;

        // $pembayarans = Pembayaran::whereIn('id', $ids)->get();

        // foreach ($pembayarans as $pembayaran) {
        //     $pembayaran->activeDate = $active_date;
        //     $pembayaran->inactiveDate = $inactive_date;
        //     $pembayaran->save();
        // }

        // $data = $pembayarans->map(function ($pembayaran) {

        //     return [
        //         'id' => $pembayaran->id,
        //         'nama' => $pembayaran->nama,
        //         'nim' => $pembayaran->nim,
        //         'activeDate' => $pembayaran->activeDate,
        //         'inactiveDate' => $pembayaran->inactiveDate,
        //         'va' => $pembayaran->nim,
        //         'amount' => $pembayaran->amount,
        //     ];
        // });

        // dd($data);






        $response = Http::withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJLYXBxMHhYSjdFUkxtck0tVGVxRXpjUnhJb1k2M0ZHNVZXZkt1TmxSMGhNIn0.eyJleHAiOjE2ODQyOTY1NDQsImlhdCI6MTY4NDI5NDc0NCwianRpIjoiOGJlMDMyYWUtYWYwNS00MzY1LTg4YzYtNGY3MTNlNGNmNDgyIiwiaXNzIjoiaHR0cHM6Ly9hY2NvdW50Lm1ha2FyYW1hcy5jb20vYXV0aC9yZWFsbXMvYnBpLWRldiIsImF1ZCI6WyJiYWNrZW5kIiwiYWNjb3VudCJdLCJzdWIiOiJiNGM5ZWI3Zi0wZDhhLTQwMjUtOTRjNy02MjdiMjFmYzQwY2EiLCJ0eXAiOiJCZWFyZXIiLCJhenAiOiJCUEkzNzY0Iiwic2Vzc2lvbl9zdGF0ZSI6ImZhZWVjZjA5LTc4OTItNDIzNC05YTFlLTU5ZmNlMWQyM2U1YSIsImFjciI6IjEiLCJhbGxvd2VkLW9yaWdpbnMiOlsiKiJdLCJyZWFsbV9hY2Nlc3MiOnsicm9sZXMiOlsib2ZmbGluZV9hY2Nlc3MiLCJ1bWFfYXV0aG9yaXphdGlvbiJdfSwicmVzb3VyY2VfYWNjZXNzIjp7ImJhY2tlbmQiOnsicm9sZXMiOlsibWVyY2hhbnQiXX0sImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJtYW5hZ2UtYWNjb3VudC1saW5rcyIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoicHJvZmlsZSBlbWFpbCIsInNpZCI6ImZhZWVjZjA5LTc4OTItNDIzNC05YTFlLTU5ZmNlMWQyM2U1YSIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJjb2RlIjoiMzc2NCIsIm5hbWUiOiJQT0xJVEVLTklLIE5FR0VSSSBJTkRSQU1BWVUiLCJwcmVmZXJyZWRfdXNlcm5hbWUiOiIzNzY0IiwiZ2l2ZW5fbmFtZSI6IlBPTElURUtOSUsgTkVHRVJJIElORFJBTUFZVSIsImZhbWlseV9uYW1lIjoiIiwiZW1haWwiOiJtaWdyYXNpMzc2NEBnbWFpbC5jb20ifQ.IHSGlSj3FYEsHwTwXKdOyaShsYyS2-slW07gGkUA_1kyLWODTkWcJ9p0mKFl3B7aMsGpJemADAhay6CpPYEvNyptgVQ_rPXHXDw2zkbU9jMtdPriVJLUO99TajSC6nfmqGqPwVcto5leHjK3_Dnbu870p0TvYkh74dgRH0YDqm6t4Z4LamggMWbhVJF-63FT32nhksHHczSx0yLs-X7ht332HmZFsNUZC6QyK2IyyIkl4c0DjkLC8w5gWCVf8u3xpLU-mYT5FOPgHNgKfWrh6kOvZ0G9pYG0ERJlF0kysB_2BOxwUelymx-nUWY8XCpc9Y74JRvvGQlLl4eZOSmz4w',
            'grant_type' => 'password',
            'client_id' => 'BPI3764',
            'client_secret' => 'cJ33C8xjyVbxTNTKCnqgrxoZaCsnvRep',
            'username' => '3764',
            'password' => '3764',
        ])->post('https://billing-bpi-dev.maja.id/api/v2/register', [
            'date' => '2022-04-23',
            'amount'=> '50000',
            'name' => 'Budi',
            'email'=>'agungmeiprasetyo@gmail.com',
            'address'=>'Depok',
            'va'=>'1234567890',
            'number'=>'SM012',
            'attribute1'=>'IPS',
            'attribute2'=>'Kelas 5',
            'sequenceNumber'=>'3',
            'items' => [
                    'description'=>'Uang Seragam',
                    'unitPrice' => '50000',
                    'qty'=> '1',
                    'amount'=> '50000'
            ],
            'attributes' => []
        ]);
    

        dd($response);

        // foreach ($ids as $data) {
        //     $response = Http::withHeaders()->get('https://api.example.com/endpoint/', [
        //         "data_aktivasi" => [

        //             $request->activeDate,
        //             $request->inactiveDate
        //         ]
        //     ]
            

        // );
        // }

        // $vaNumber = '123456789012345';
        // $amount = 100000;
        // $transactionDate = date('Y-m-d');

        // $activasi = $this->bsiApiService->createTransaction([
        //     'va_number' => $vaNumber,
        //     'amount' => $amount,
        //     'transaction_date' => $transactionDate,
        // ]);

        // $transaction = response()->json($activasi);

        // $paid = $transaction['paid'];
        // $pembayaran = Pembayaran::find($ids);
        // $pembayaran->paid = $paid;
        // $pembayaran->save();

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
                $orderBy = 'pembayaran.openPayment';
                break;
            default:
                $orderBy = 'pembayaran.nim';
                break;
        }

        $data = Pembayaran::select([
            'pembayaran.*',
            'kategori_pembayaran.kategori_pembayaran as nama_kategori'
        ])->orderBy($orderBy, $request->input('order.0.dir'))->join('kategori_pembayaran','kategori_pembayaran.id','=','pembayaran.kategori_pembayaran_id');

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
