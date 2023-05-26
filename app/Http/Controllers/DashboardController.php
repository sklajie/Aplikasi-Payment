<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        // $result = DB::select(DB::raw("select count(nullif(status, true)) as belum_terbayar, count(nullif(status, false)) as terbayar from pembayaran"));       
        // $data = "";
        // foreach($result as $value){
        //     $data ="$value->status";
        // }
        // $piechart = $data;
        $pembayaran = Pembayaran::select('status',DB::raw("COUNT(id) as count"))
                    ->groupBy('status')->get();


        $belumlunas = Pembayaran::select('status',DB::raw("COUNT(id) as count"))->where('status', 0)
                    ->groupBy('status')->get();
        $lunas = Pembayaran::select('status',DB::raw("COUNT(id) as count"))->where('status', 1)
                    ->groupBy('status')->get();
        $countlunas = DB::table('pembayaran')->where('status', 1)->count();
        $countbelumlunas = DB::table('pembayaran')->where('status', 0)->count();
                    
        return view('home', compact('title', 'pembayaran'));
    }
}
