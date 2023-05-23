<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BsiController extends Controller
{
    public function sendRequestToBsi()
    {
        $response = Http::asForm()->post('https://account.makaramas.com/auth/realms/bpi-dev/protocol/openid-connect/token', [
            'grant_type' => 'password',
            'client_id' => 'BPI3764',
            'client_secret' => 'cJ33C8xjyVbxTNTKCnqgrxoZaCsnvRep',
            'username' => '3764',
            'password' => '3764',
        ]);
        
        $accessToken = $response['access_token'];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '. $accessToken,
            ])->post('https://billing-bpi-dev.maja.id/api/v2/register', [
            'date' => '2022-04-23',
            'amount'=> 50000,
            'name' => 'Budi',
            'email'=>'agungmeiprasetyo@gmail.com',
            'address'=>'Depok',
            'va'=>'1234567890',
            'number'=>'SM012',
            'attribute1'=>'IPS',
            'attribute2'=>'Kelas 5',
            'sequenceNumber'=>'3',
            'items' => [
                [
                    'description'=>'Uang Seragam',
                    'unitPrice' => 50000,
                    'qty'=> '1',
                    'amount'=> 50000
                ]
            ],
            'attributes' => []
        ]);
    }
};