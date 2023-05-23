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
        // $result = DB::select(DB::raw("SELECT COALESCE(sum(CASE WHEN status THEN 1 ELSE 0 END),0)as terbayar FROM pembayaran;"));       
        // $data = "";
        // foreach($result as $value){
        //     $data ="$value->status";
        // }
        // $piechart = $data;

        return view('home', compact('title'));
    }
}
