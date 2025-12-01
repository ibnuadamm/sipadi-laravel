<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persediaan;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    protected $fillable = [
        'persediaan_id',
        'qty',
        'harga_satuan',
        'tanggal',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function persediaan()
    {
        return $this->belongsTo(Persediaan::class, 'persediaan_id');
    }

    // Subtotal otomatis
    public function getSubtotalAttribute()
    {
        return $this->qty * $this->harga_satuan;
    }
}
