<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class HistoriRespons extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'regis_number',
        'amount',
        'user_id',
        'created_date',
    ];

    // Generate UUID saat menyimpan model
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

    protected $table = "histori_respons";

    protected $response = []; // property untuk menyimpan seluruh data response dari API

    public function setResponse($response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
