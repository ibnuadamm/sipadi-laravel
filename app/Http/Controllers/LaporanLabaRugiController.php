<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Pembelian;
use App\Models\Beban;

class LaporanLabaRugiController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', 'all'); // 'all' = semua bulan
        $tahun = $request->input('tahun', 'all'); // 'all' = semua tahun

        $queryPenjualan = Penjualan::query();
        $queryPembelian = Pembelian::query();
        $queryBeban = Beban::query();

        // Filter tanggal jika bukan "all"
        if($bulan !== 'all' && $tahun !== 'all') {
            $startDate = "$tahun-$bulan-01";
            $endDate = date("Y-m-t", strtotime($startDate));
            $queryPenjualan->whereBetween('tanggal', [$startDate, $endDate]);
            $queryPembelian->whereBetween('tanggal', [$startDate, $endDate]);
            $queryBeban->whereBetween('tanggal', [$startDate, $endDate]);
        } elseif($bulan === 'all' && $tahun !== 'all') {
            // Semua bulan di tahun tertentu
            $queryPenjualan->whereYear('tanggal', $tahun);
            $queryPembelian->whereYear('tanggal', $tahun);
            $queryBeban->whereYear('tanggal', $tahun);
        }

        // Total Penjualan
        $totalPenjualan = $queryPenjualan->sum('subtotal');

        // Total Pembelian / HPP (qty * harga_satuan)
        $totalPembelian = $queryPembelian->get()->sum(function($item){
            return $item->qty * $item->harga_satuan;
        });

        // Total Beban
        $totalBeban = $queryBeban->sum('nominal');

        // Laba/Rugi Bersih
        $labaRugi = $totalPenjualan - $totalPembelian - $totalBeban;

        return view('laporan.laba_rugi', compact(
            'totalPenjualan',
            'totalPembelian',
            'totalBeban',
            'labaRugi',
            'bulan',
            'tahun'
        ));
    }
}
