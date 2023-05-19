<?php

namespace App\Imports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class pembayaranImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $now = date('Y-m-d H:i:s');
        return new Pembayaran([
            'id' => $row['id'],
            'kategori_pembayaran_id' => $row['kategori_pembayaran_id'],
            'nama'=>$row['nama'],
            'nim'=>$row['nim'],
            'email'=>$row['email'],
            'phone'=>$row['phone'],
            'address'=>$row['address'],
            'semester'=>$row['semester'],
            'tahun_akademik'=> $row['tahun_akademik'],
            'prodi'=> $row['prodi'],
            'va'=> $row['va'],
            'amount'=> $row['amount'],
            'openPayment'=> '0',
            'activeDate'=> '2023-6-17',
            'inactiveDate'=> '2023-6-29',
            'date'=>$now,
            'item_pembayaran_id'=>$row['item_pembayaran_id'],
            
        ]);
    }
}
