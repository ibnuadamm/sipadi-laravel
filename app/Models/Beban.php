<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beban extends Model
{
    use HasFactory;

    protected $table = 'beban';

    protected $fillable = [
        'tanggal',
        'nama_beban',
        'nominal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
