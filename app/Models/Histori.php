<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Histori extends Model
{
    use HasFactory;

    protected $table = 'histori';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'pembayaran_lainnya_id',
        'method',
        'request_body',
        'respons',
        'user_id',
    ];
    
    // Generate UUID saat menyimpan model
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

    protected $response = []; // property untuk menyimpan seluruh data response dari API

    public function setResponse($response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }

    // Definisikan relasi dengan model PembayaranLainnya
    public function pembayaranLainnya()
    {
        return $this->belongsTo(PembayaranLainnya::class, 'pembayaran_lainnya_id', 'id');
    }
}
