<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persediaan extends Model
{
    use HasFactory;

    protected $table = 'persediaan';

    protected $fillable = [
        'kategori',
        'nama_barang',
        'stok_awal',
        'satuan',
    ];

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'persediaan_id');
    }

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'persediaan_id');
    }

    public function pemantauan()
    {
        return $this->hasMany(Pemantauan::class, 'persediaan_id');
    }

    /**
     * Stok berjalan = stok_awal + pembelian - penjualan - tanam + panen
     */
    public function getStokBerjalanAttribute()
    {
        $masukPembelian = $this->pembelians()->sum('qty');
        $keluarPenjualan = $this->penjualans()->sum('qty');

        $totalTanam = $this->pemantauan()->sum('jumlah_tanam');
        $totalPanen = $this->pemantauan()->sum('jumlah_panen');

        return $this->stok_awal 
             + $masukPembelian 
             - $keluarPenjualan 
             - $totalTanam 
             + $totalPanen;
    }
}
