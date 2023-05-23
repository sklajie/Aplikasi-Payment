<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $result = DB::select(DB::raw("select count(nullif(status, true)) as belum_terbayar, count(nullif(status, false)) as terbayar from pembayaran"));       
        $data = "";
        foreach($result as $value){
            $data ="$value->status";
        }
        $piechart = $data;

        return view('home', compact('title','result'));
    }
}
