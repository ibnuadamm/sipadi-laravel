<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persediaan;
use App\Models\Pembelian;
use App\Models\Penjualan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPersediaan = Persediaan::count();
        $totalPembelian = Pembelian::sum('qty');
        $totalPenjualan = Penjualan::sum('qty');

        $stokPersediaan = Persediaan::with(['pembelians', 'penjualans'])->get();

        return view('dashboard', compact(
            'totalPersediaan',
            'totalPembelian',
            'totalPenjualan',
            'stokPersediaan'
        ));
    }
}
