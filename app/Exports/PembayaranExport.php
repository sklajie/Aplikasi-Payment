<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembayaranExport implements FromQuery, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $list_id = [];
    function __construct($list_id=[]) {
        $this->list_id = $list_id;
    }

    public function query()
    {
        $data = Pembayaran::query();
        if(count($this->list_id)>0) $data = $data->whereIn('id',$this->list_id);
        return $data;
    }

	public function headings(): array
    {
        return [
            'nama',
			'nomor_ktp',
			'nik',
			'telp',
			'email',
			'detail_alamat',
			'status',
			'nomor_bpjs_kesehatan',
			'nomor_bpjs_ketenagakerjaan',
			'organisasi_id'
        ];
    }
    
    public function map($pembayaran): array
    {
        return [
            $pembayaran->nama,
            $pembayaran->nomor_ktp,
            $pembayaran->nik,
            $pembayaran->telp,
            $pembayaran->email,
            $pembayaran->detail_alamat,
            $pembayaran->status,
            $pembayaran->nomor_bpjs_kesehatan,
            $pembayaran->nomor_bpjs_ketenagakerjaan,
            $pembayaran->organisasi_id,
        ];
    }
}
