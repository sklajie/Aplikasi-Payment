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
            'kategori_pembayaran',
            'nama',
            'nim',
            'email',
            'phone',
            'address',
            'semester',
            'tahun_akademik',
            'prodi',
            'amount',
            'date',
        ];
    }
    
    public function map($pembayaran): array
    {
        return [
            $pembayaran->kategori_pembayaran,
            $pembayaran->nama,
            $pembayaran->nim,
            $pembayaran->email,
            $pembayaran->phone,
            $pembayaran->address,
            $pembayaran->semester,
            $pembayaran->tahun_akademik,
            $pembayaran->prodi,
            $pembayaran->amount,
            $pembayaran->date,
        ];
    }
}
