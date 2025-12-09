@extends('layouts.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #2d5a3d 0%, #1f4630 100%);
        min-height: 100vh;
        padding-top: 70px;
        font-family: Arial, sans-serif;
    }

    /* Wave effect di background ATAS */
    body::before {
        content: '';
        position: fixed;
        top: 70px;
        left: 0;
        width: 100%;
        height: 120px;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"><path d="M0,50 Q300,0 600,50 T1200,50 L1200,0 L0,0 Z" fill="rgba(255,255,255,0.15)"/></svg>');
        background-repeat: repeat-x;
        background-position: 0 0;
        animation: wave 15s linear infinite;
        z-index: 0;
        pointer-events: none;
    }

    /* Wave effect di background BAWAH */
    body::after {
        content: '';
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 200px;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"><path d="M0,50 Q300,0 600,50 T1200,50 L1200,120 L0,120 Z" fill="rgba(255,255,255,0.1)"/></svg>');
        background-repeat: repeat-x;
        background-position: 0 0;
        animation: wave 15s linear infinite;
        z-index: 1;
        pointer-events: none;
    }

    @keyframes wave {
        0% { background-position: 0 0; }
        100% { background-position: 1200px 0; }
    }

    /* Navbar - MENYATU 100% DENGAN BACKGROUND */
    .navbar-simple {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 70px;
        background: transparent;
        z-index: 1000;
        display: flex;
        align-items: center;
        padding: 0 20px;
        justify-content: space-between;
        gap: 20px;
    }

    /* Logo Section */
    .navbar-logo-section {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .navbar-logo-icon {
        width: 38px;
        height: 38px;
        background: linear-gradient(135deg, #4CAF50 0%, #2d5a3d 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
    }

    .navbar-logo-text {
        color: white;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    /* Menu Items */
    .navbar-menu-items {
        display: flex;
        gap: 8px;
        flex: 1;
        justify-content: center;
        align-items: center;
        margin: 0;
        list-style: none;
        flex-wrap: wrap;
    }

    .navbar-menu-items a {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        font-size: 12px;
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
        transition: all 0.2s ease;
    }

    .navbar-menu-items a:hover {
        color: white;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 6px;
        padding: 16px;
    }

    .navbar-menu-items i {
        font-size: 13px;
    }

    /* Logout Button */
    .navbar-logout-btn {
        background: rgba(229, 57, 53, 0.9);
        border: none;
        color: white;
        padding: 6px 14px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .navbar-logout-btn:hover {
        background: rgba(198, 40, 40, 0.95);
        transform: translateY(-2px);
    }

    .navbar-logout-btn i {
        font-size: 13px;
    }

    /* Container utama */
    .dashboard-container {
        position: relative;
        z-index: 2;
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Ringkasan Cards - TRANSPARAN */
    .summary-section {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .summary-card {
        flex: 1;
        min-width: 250px;
        background: rgba(255, 255, 255, 0.2);
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }

    .summary-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        background: rgba(255, 255, 255, 0.25);
    }

    .summary-card h3 {
        color: white;
        margin: 0 0 12px 0;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .summary-card p {
        color: white;
        font-size: 32px;
        font-weight: bold;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Table Section */
    h2 {
        color: white;
        margin-top: 30px;
        margin-bottom: 20px;
        font-size: 20px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* TABEL TRANSPARAN */
    table {
        width: 100%;
        border-collapse: collapse;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    table tr:first-child {
        background: rgba(255, 255, 255, 0.2);
    }

    table th {
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    table td {
        padding: 12px 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 14px;
        font-weight: 500;
    }

    table tr:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    table tr:last-child td {
        border-bottom: none;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<!-- Navbar -->
<nav class="navbar-simple">
    <!-- Logo -->
    <div class="navbar-logo-section">
        <div class="navbar-logo-icon"><i class="bi bi-gear"></i></div>
        <span class="navbar-logo-text">SIPADI</span>
    </div>

    <!-- Menu Items -->
    <ul class="navbar-menu-items">
        <li><a href="{{ route('persediaan.index') }}"><i class="bi bi-box-seam"></i> Persediaan</a></li>
        <li><a href="{{ route('pembelian.index') }}"><i class="bi bi-cart-plus"></i> Pembelian</a></li>
        <li><a href="{{ route('penjualan.index') }}"><i class="bi bi-bag-check"></i> Penjualan</a></li>
        <li><a href="{{ route('pemantauan.index') }}"><i class="bi bi-eye"></i> Pantau</a></li>
        <li><a href="{{ route('beban.index') }}"><i class="bi bi-wallet2"></i> Beban</a></li>
        <li><a href="{{ route('laporan.laba_rugi') }}"><i class="bi bi-graph-up"></i> Laba Rugi</a></li>
        <li><a href="{{ route('laporan.biaya_produksi') }}"><i class="bi bi-calculator"></i> Biaya</a></li>
        <li><a href="{{ route('prediksi.index') }}"><i class="bi bi-robot"></i> Prediksi</a></li>
    </ul>

    <!-- Logout -->
    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
        @csrf
        <button type="submit" class="navbar-logout-btn">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>
</nav>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('active');
    }

    document.addEventListener('click', function(event) {
        const navbar = document.querySelector('.navbar-dropdown');
        if (navbar && !navbar.contains(event.target)) {
            document.getElementById('dropdownMenu').classList.remove('active');
        }
    });
</script>

<div class="dashboard-container">
    <!-- Ringkasan -->
    <div class="summary-section">
        <div class="summary-card">
            <h3>Total Persediaan</h3>
            <p>{{ $totalPersediaan }}</p>
        </div>
        <div class="summary-card">
            <h3>Total Pembelian (Qty)</h3>
            <p>{{ $totalPembelian }}</p>
        </div>
        <div class="summary-card">
            <h3>Total Penjualan (Qty)</h3>
            <p>{{ $totalPenjualan }}</p>
        </div>
    </div>

    <h2>Stok Persediaan Berjalan</h2>
    <table>
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
</div>

@endsection