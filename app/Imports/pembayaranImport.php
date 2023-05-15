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
            'nama'=>$row['nama'],
            'nim'=>$row['nim'],
            'kategori_pembayaran_id' => 'UKT',
            'email'=>$row['email'],
            'phone'=>$row['phone'],
            'address'=>$row['alamat'],
            'semester'=>$row['semester'],
            'tahun_akademik'=>$row['tahun akademik'],
            'prodi'=>$row['prodi'],
            'va'=>$row['va'],
            'amount'=>$row['ukt'],
        ]);
    }
}
