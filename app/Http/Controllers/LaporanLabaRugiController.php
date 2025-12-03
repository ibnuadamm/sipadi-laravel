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
    $bulan = $request->input('bulan', 'all');
    $tahun = $request->input('tahun', 'all');

    $queryPenjualan = Penjualan::with('persediaan');
    $queryPembelian = Pembelian::with('persediaan');
    $queryBeban = Beban::query();

    // Filter
    if ($bulan !== 'all' && $tahun !== 'all') {
        $startDate = "$tahun-$bulan-01";
        $endDate = date("Y-m-t", strtotime($startDate));

        $queryPenjualan->whereBetween('tanggal', [$startDate, $endDate]);
        $queryPembelian->whereBetween('tanggal', [$startDate, $endDate]);
        $queryBeban->whereBetween('tanggal', [$startDate, $endDate]);
    } elseif ($bulan === 'all' && $tahun !== 'all') {
        $queryPenjualan->whereYear('tanggal', $tahun);
        $queryPembelian->whereYear('tanggal', $tahun);
        $queryBeban->whereYear('tanggal', $tahun);
    }

    // Ambil Detail
    $detailPenjualan = $queryPenjualan->get();
    $detailPembelian = $queryPembelian->get();
    $detailBeban = $queryBeban->get();

    // Hitung Total
    $totalPenjualan = $detailPenjualan->sum('subtotal');

    $totalPembelian = $detailPembelian->sum(function ($item) {
        return $item->qty * $item->harga_satuan;
    });

    $totalBeban = $detailBeban->sum('nominal');

    $labaRugi = $totalPenjualan - $totalPembelian - $totalBeban;

    return view('laporan.laba_rugi', compact(
        'bulan', 'tahun',
        'totalPenjualan',
        'totalPembelian',
        'totalBeban',
        'labaRugi',
        'detailPenjualan',
        'detailPembelian',
        'detailBeban'
    ));
}
}