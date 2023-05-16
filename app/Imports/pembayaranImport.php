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
            'id' => $row['Nomor Tagihan'],
            'nama'=>$row['Nama'],
            'nim'=>$row['Nomor Pembayaran'],
            'kategori_pembayaran_id' => $row['Jenis Tagihan'],
            'email'=>$row['email'],
            'phone'=>$row['Telepon'],
            'va'=>$row['Nomor Pembayaran'],
            'amount'=>$row['Nominal 1'],
        ]);
    }
}
