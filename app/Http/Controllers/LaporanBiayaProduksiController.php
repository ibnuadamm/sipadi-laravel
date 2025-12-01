<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Beban;
use Illuminate\Http\Request;

class LaporanBiayaProduksiController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        // Query Pembelian
        $queryPembelian = Pembelian::with('persediaan')->orderBy('tanggal', 'asc');

        // Query Beban
        $queryBeban = Beban::orderBy('tanggal', 'asc');

        if ($bulan) {
            $queryPembelian->whereMonth('tanggal', $bulan);
            $queryBeban->whereMonth('tanggal', $bulan);
        }

        if ($tahun) {
            $queryPembelian->whereYear('tanggal', $tahun);
            $queryBeban->whereYear('tanggal', $tahun);
        }

        $pembelian = $queryPembelian->get();
        $beban = $queryBeban->get();

        // Hitung total bahan baku
        $totalBahanBaku = $pembelian->sum(fn ($item) => $item->qty * $item->harga_satuan);

        // Total Beban Produksi
        $totalBebanProduksi = $beban->sum('nominal');

        // Total Biaya Produksi
        $totalBiayaProduksi = $totalBahanBaku + $totalBebanProduksi;

        return view('laporan.biaya_produksi', compact(
            'bulan',
            'tahun',
            'pembelian',
            'beban',
            'totalBahanBaku',
            'totalBebanProduksi',
            'totalBiayaProduksi'
        ));
    }
}
