<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan'; // sesuaikan dengan tabel db

    protected $fillable = [
        'persediaan_id',
        'qty',
        'harga_satuan',
        'subtotal',
        'tanggal',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function persediaan()
    {
        return $this->belongsTo(Persediaan::class);
    }
}

