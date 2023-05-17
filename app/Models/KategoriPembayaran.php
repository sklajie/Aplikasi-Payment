<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\str;

class KategoriPembayaran extends Model
{
    use HasFactory;
    protected $table = 'kategori_pembayaran';
    protected $fillable = [
        'kategori_pembayaran'
    ];

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

    public function pembayaran(){
        return $this->hasMany(pembayaran::class);
    }
}
