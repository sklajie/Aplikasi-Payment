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
            'id' => Str::uuid(),
            'kategori_pembayaran' => $row['kategori_pembayaran'],
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
            'status'=> '0',
            'activeDate'=> '2023-6-17',
            'inactiveDate'=> '2023-6-29',            
        ]);
    }
}
