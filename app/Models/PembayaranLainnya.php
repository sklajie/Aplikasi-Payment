<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Traits\Uuid;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembayaranLainnya extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_lainnya';
    protected $guarded = [''];

    protected $fillable = [
        'name',
        'email',
        'amount',
        'regis_number',
        'invoice_number',
        'created_at',
        'updated_at',
        'paid_date',
        'paid',
        'id_user',
        'jenis_pembayaran',
        'debug',
    ];

    /**
     * Kita override boot method
     *
     * Mengisi primary key secara otomatis dengan UUID ketika membuat record
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    /**
     * Kita override getIncrementing method
     *
     * Menonaktifkan auto increment
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Kita override getKeyType method
     *
     * Memberi tahu laravel bahwa model ini menggunakan primary key bertipe string
     */
    public function getKeyType()
    {
        return 'string';
    }

    public function setResponse($response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }

    // Definisikan relasi dengan model Histori
    public function histori()
    {
        return $this->hasOne(Histori::class, 'pembayaran_lainnya_id');
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Histori::class, 'pembayaran_lainnya_id', 'id', 'id', 'user_id');
    }

}
