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
            'nama'=>$row['nama'],
            'nim'=>$row['nim'],
            'kategori_pembayaran_id' => $row['kategori_pembayaran_id'],
            'email'=>$row['email'],
            'phone'=>$row['phone'],
            'va'=>$row['va'],
            'amount'=>$row['amount'],
        ]);
    }
}
