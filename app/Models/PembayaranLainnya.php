<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranLainnya extends Model
{
    use HasFactory;
    protected $table = 'pembayaran_lainnya';
    protected $guarded = [''];
}
