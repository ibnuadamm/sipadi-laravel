@extends('layouts.app')

@section('content')
<h1 style="display:flex; justify-content:space-between; align-items:center;">
    Dashboard

    <!-- Tombol Logout -->
    <form action="{{ route('logout') }}" method="POST" style="margin:0;">
        @csrf
        <button 
            style="padding:8px 16px; background-color:#e53935; color:white; border:none; cursor:pointer; border-radius:4px;">
            Logout
        </button>
    </form>
</h1>

<!-- Tombol Navigasi -->
<div style="margin-bottom:20px; display:flex; gap:10px; flex-wrap:wrap;">

    <a href="{{ route('persediaan.index') }}">
        <button style="padding:10px 20px; background-color:#4CAF50; color:white; border:none; cursor:pointer;">
            Persediaan
        </button>
    </a>

    <a href="{{ route('pembelian.index') }}">
        <button style="padding:10px 20px; background-color:#2196F3; color:white; border:none; cursor:pointer;">
            Pembelian
        </button>
    </a>

    <a href="{{ route('penjualan.index') }}">
        <button style="padding:10px 20px; background-color:#f44336; color:white; border:none; cursor:pointer;">
            Penjualan
        </button>
    </a>

    <a href="{{ route('pemantauan.index') }}">
        <button style="padding:10px 20px; background-color:#9C27B0; color:white; border:none; cursor:pointer;">
            Pemantauan
        </button>
    </a>

    <a href="{{ route('beban.index') }}">
        <button style="padding:10px 20px; background-color:#FF9800; color:white; border:none; cursor:pointer;">
            Beban Operasional
        </button>
    </a>

    <a href="{{ route('laporan.laba_rugi') }}">
        <button style="padding:10px 20px; background-color:#795548; color:white; border:none; cursor:pointer;">
            Laporan Laba Rugi
        </button>
    </a>

    <a href="{{ route('laporan.biaya_produksi') }}">
        <button style="padding:10px 20px; background-color:#607D8B; color:white; border:none; cursor:pointer;">
            Laporan Biaya Produksi
        </button>
    </a>

    <a href="{{ route('prediksi.index') }}">
        <button style="padding:10px 20px; background-color:#009688; color:white; border:none; cursor:pointer;">
            Prediksi Harga Jual AI
        </button>
    </a>

</div>

<!-- Ringkasan -->
<div style="display:flex; gap:20px; margin-bottom:30px;">
    <div style="border:1px solid #ccc; padding:20px;">
        <h3>Total Persediaan</h3>
        <p>{{ $totalPersediaan }}</p>
    </div>
    <div style="border:1px solid #ccc; padding:20px;">
        <h3>Total Pembelian (Qty)</h3>
        <p>{{ $totalPembelian }}</p>
    </div>
    <div style="border:1px solid #ccc; padding:20px;">
        <h3>Total Penjualan (Qty)</h3>
        <p>{{ $totalPenjualan }}</p>
    </div>
</div>

<h2>Stok Persediaan Berjalan</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>Barang</th>
        <th>Stok Awal</th>
        <th>Masuk (Pembelian)</th>
        <th>Keluar (Penjualan)</th>
        <th>Stok Berjalan</th>
    </tr>

    @foreach($stokPersediaan as $item)
    <tr>
        <td>{{ $item->nama_barang }}</td>
        <td>{{ $item->stok_awal }}</td>
        <td>{{ $item->pembelians->sum('qty') }}</td>
        <td>{{ $item->penjualans->sum('qty') }}</td>
        <td>{{ $item->stok_awal + $item->pembelians->sum('qty') - $item->penjualans->sum('qty') }}</td>
    </tr>
    @endforeach
</table>

@endsection
