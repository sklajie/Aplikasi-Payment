<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/pembayaran',
        '/pembayaran/data',
        '/pembayaran/store',
        '/log_transaksi/data',
        '/log_transaksi',
        '/log_transaksi_dev/data',
        '/log_transaksi_dev',
        '/pembayaran/export_data_terpilih',
        '/pembayaran_dibayar',
        '/pembayaran_dibayar/data_dibayar',
        '/pembayaran_lainnya',
        '/pembayaran_lainnya/data',
    ];
}
