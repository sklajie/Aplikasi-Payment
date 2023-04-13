<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CekController extends Controller
{
    public function index(){
        $response = Http::withHeaders([
            'key' => '53ffecbb88839c40bf42b0faf05a17a6'
        ])->get('https://api.rajaongkir.com/starter/city');

        $cities = $response['rajaongkir']['result'];
        return view('welcome');
    }
}
