<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

class PembayaranLainnya extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_lainnya';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'email',
        'regis_number',
        'amount',
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

    // Definisikan relasi dengan model Histori
    public function histori(){
        return $this->hasMany(Histori::class);
    }
}
