@extends('layouts.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #6f835bff 20%, #36574aff 100%);
        min-height: 100vh;
        padding-top: 70px;
        font-family: Arial, sans-serif;
        position: relative;
    }

    /* Wave bawah */
    body::after {
        content: '';
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 140px;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160"><path d="M0,80 C240,160 480,160 720,80 C960,0 1200,0 1440,80 L1440,160 L0,160 Z" fill="rgba(255,255,255,0.22)"/></svg>');
        background-repeat: repeat-x;
        animation: wave 18s linear infinite reverse;
        z-index: 1;
        pointer-events: none;
    }

    @keyframes wave {
        0% {
            background-position: 0 0;
        }

        100% {
            background-position: 1440px 0;
        }
    }


    /* ================================================================
       🌱 BENIH KECIL (VERSI BARU)
       ================================================================ */
    .seed-particle-container {
        position: fixed;
        top: 45%;
        left: 50%;
        width: 0;
        height: 0;
        pointer-events: none;
        z-index: 4;
    }

    .seed-particle {
        position: absolute;
        border-radius: 50%;
        background: radial-gradient(circle,
                rgba(220, 255, 230, 0.9),
                rgba(150, 230, 170, 0.45),
                rgba(80, 150, 110, 0.15));
        opacity: 0.9;
        filter: blur(0.6px);
        animation: seedFloat linear infinite;
    }

    @keyframes seedFloat {
        0% {
            transform: translate(0, 0) scale(1);
            opacity: 0.8;
        }

        25% {
            transform: translate(40px, -30px) scale(1.05);
        }

        50% {
            transform: translate(-60px, -10px) scale(0.95);
            opacity: 1;
        }

        75% {
            transform: translate(25px, 20px) scale(1.1);
        }

        100% {
            transform: translate(0, 0) scale(1);
            opacity: 0.8;
        }
    }


    /* ================================================================
        NAVBAR
    ================================================================ */
    .navbar-simple {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 70px;
        background: rgba(45, 90, 61, 0.3);
        backdrop-filter: blur(10px);
        z-index: 1000;
        display: flex;
        align-items: center;
        padding: 0 20px;
        justify-content: space-between;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .navbar-logo-section {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .navbar-logo-img {
        width: 70px;
        height: 70px;
        filter: brightness(0) invert(1);
    }

    .navbar-logo-text {
        color: white;
        font-size: 16px;
        font-weight: 700;
    }

    .navbar-menu-items {
        display: flex;
        gap: 8px;
        flex: 1;
        justify-content: center;
        list-style: none;
    }

    .navbar-menu-items a {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        font-size: 12px;
        padding: 6px 12px;
        border-radius: 6px;
        transition: 0.2s;
    }

    .navbar-menu-items a:hover {
        color: white;
        background: rgba(255, 255, 255, 0.15);
        padding: 16px;
    }

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
        transition: all 0.3s;
    }

    .navbar-logout-btn:hover {
        background: rgba(198, 40, 40, 0.95);
        transform: translateY(-2px);
    }


    /* ================================================================
        DASHBOARD
    ================================================================ */
    .dashboard-container {
        position: relative;
        z-index: 5;
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

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
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .summary-card h3 {
        color: white;
        font-size: 13px;
        margin-bottom: 12px;
    }

    .summary-card p {
        color: white;
        font-size: 32px;
        font-weight: bold;
        margin: 0;
    }

    h2 {
        color: white;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 10px;
        overflow: hidden;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    table th,
    table td {
        color: white;
        padding: 15px;
    }

    table tr:hover {
        background: rgba(255, 255, 255, 0.1);
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<nav class="navbar-simple">
    <div class="navbar-logo-section">
        <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 10px;">
            <img src="/image/logo-sipadi.png" class="navbar-logo-img">
            <span class="navbar-logo-text">SIPADI</span>
        </a>
    </div>

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

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="navbar-logout-btn">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>
</nav>


<!-- 🌱 BENIH KECIL -->
<div class="seed-particle-container" id="seedParticles"></div>


<div class="dashboard-container">
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
            <th>Masuk</th>
            <th>Keluar</th>
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


<!-- SCRIPT BENIH KECIL -->
<script>
    const container = document.getElementById('seedParticles');

    for (let i = 0; i < 45; i++) { // lebih banyak
        let seed = document.createElement('div');
        seed.classList.add('seed-particle');

        let size = Math.random() * 6 + 3;
        let offsetX = (Math.random() * 420) - 210; // lebih melebar
        let offsetY = (Math.random() * 260) - 130;

        seed.style.width = size + 'px';
        seed.style.height = size + 'px';
        seed.style.left = offsetX + 'px';
        seed.style.top = offsetY + 'px';

        seed.style.animationDuration = (5 + Math.random() * 6) + 's';

        container.appendChild(seed);
    }
</script>

@endsection