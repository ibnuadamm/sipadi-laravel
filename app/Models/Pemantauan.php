<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemantauan extends Model
{
    use HasFactory;

    protected $table = 'pemantauan';

    protected $fillable = [
    'persediaan_id',
    'lahan',
    'tanggal_tanam',
    'jumlah_tanam',
    'tanggal_panen',
    'jumlah_panen',
];

    protected $casts = [
        'tanggal_tanam' => 'date',
        'tanggal_panen' => 'date',
    ];

    public function persediaan()
    {
        return $this->belongsTo(Persediaan::class, 'persediaan_id');
    }

    // ➤ STATUS OTOMATIS
    public function getStatusAttribute()
    {
        if ($this->tanggal_panen && $this->jumlah_panen) {
            return 'Sudah Dipanen';
        }
        return 'Dalam Pemeliharaan';
    }
}
