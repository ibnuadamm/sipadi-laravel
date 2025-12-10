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

    .navbar-logo-section a {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .navbar-logo-section a:hover {
        opacity: 0.8;
        transform: scale(1.02);
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
        CONTAINER
    ================================================================ */
    .dashboard-container {
        position: relative;
        z-index: 5;
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 20px 100px 20px;
    }

    /* Header Section */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
    }

    h1 {
        color: white;
        font-size: 28px;
        margin: 0;
        font-weight: 700;
    }

    h3 {
        color: white;
        font-size: 16px;
        margin: 0;
        font-weight: 700;
    }

    /* Tambah Button */
    .btn-tambah {
        background: linear-gradient(135deg, #6f835bff 0%, #36574aff 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .btn-tambah:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(111, 131, 91, 0.3);
    }

    /* Alert Success */
    .alert-success {
        background: rgba(76, 175, 80, 0.2);
        border-left: 4px solid rgba(76, 175, 80, 0.8);
        color: white;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(76, 175, 80, 0.3);
    }

    /* Filter Form */
    .filter-section {
        background: rgba(255, 255, 255, 0.15);
        padding: 20px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 25px;
    }

    .filter-section h3 {
        margin-bottom: 15px;
    }

    .filter-form {
        display: flex;
        gap: 10px;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .filter-form select,
    .filter-form button {
        padding: 10px 15px;
        border-radius: 6px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .filter-form select:hover,
    .filter-form select:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
        outline: none;
    }

    .filter-form select {
        appearance: none;
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8"><path d="M1 1l5 5 5-5" stroke="rgba(255,255,255,0.6)" fill="none" stroke-width="2" stroke-linecap="round"/></svg>');
        background-repeat: no-repeat;
        background-position: right 8px center;
        padding-right: 30px;
    }

    .filter-form button {
        background: linear-gradient(135deg, #6f835bff 0%, #36574aff 100%);
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .filter-form button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(111, 131, 91, 0.3);
    }

    .filter-form select option {
        background: #36574a;
        color: white;
    }

    /* Total Summary Card */
    .summary-card {
        background: rgba(255, 255, 255, 0.15);
        padding: 20px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 20px;
    }

    .summary-card h3 {
        margin-bottom: 10px;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .summary-card .total-amount {
        font-size: 28px;
        font-weight: bold;
        color: #81C784;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* TABEL TRANSPARAN */
    table {
        width: 100%;
        border-collapse: collapse;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 10px;
        overflow: hidden;
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
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    table td {
        padding: 12px 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 14px;
    }

    table tr:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    table tr:last-child td {
        border-bottom: none;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: rgba(255, 255, 255, 0.7);
        font-size: 16px;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 15px;
        display: block;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .navbar-menu-items {
            gap: 4px;
        }

        .navbar-menu-items a {
            padding: 4px 8px;
            font-size: 11px;
        }

        h1 {
            font-size: 20px;
        }

        .header-section {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-tambah {
            width: 100%;
            justify-content: center;
        }

        .filter-form {
            flex-direction: column;
        }

        .filter-form select,
        .filter-form button {
            width: 100%;
        }

        table {
            font-size: 12px;
        }

        table th,
        table td {
            padding: 10px;
        }
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<!-- Navbar -->
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
    <!-- Header Section dengan Title dan Actions -->
    <div class="header-section">
        <h1><i class="bi bi-wallet2"></i> Data Beban Operasional</h1>
        <a href="{{ route('beban.create') }}" class="btn-tambah">
            <i class="bi bi-plus-circle"></i> Tambah Beban
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert-success">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Filter Section -->
    <div class="filter-section">
        <h3><i class="bi bi-funnel"></i> Filter Beban</h3>
        
        @php
            $namaBulan = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei',
                6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                10 => 'Oktober', 11 => 'November', 12 => 'Desember',
            ];
        @endphp

        <form method="GET" action="{{ route('beban.index') }}" class="filter-form">
            <select name="month">
                <option value="">-- Bulan --</option>
                @foreach($namaBulan as $num => $nama)
                    <option value="{{ $num }}" {{ (isset($month) && $month == $num) ? 'selected' : '' }}>
                        {{ $nama }}
                    </option>
                @endforeach
            </select>

            <select name="year">
                <option value="">-- Tahun --</option>
                @for($i = 2023; $i <= date('Y'); $i++)
                    <option value="{{ $i }}" {{ (isset($year) && $year == $i) ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>

            <button type="submit"><i class="bi bi-search"></i> Filter</button>
        </form>
    </div>

    <!-- Total Beban Summary -->
    @if(isset($month) && isset($year) && $month && $year)
        <div class="summary-card">
            <h3>Total Beban di Bulan {{ $namaBulan[$month] }} {{ $year }}</h3>
            <div class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</div>
        </div>
    @elseif(isset($year) && $year)
        <div class="summary-card">
            <h3>Total Beban di Tahun {{ $year }}</h3>
            <div class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</div>
        </div>
    @endif

    <!-- Data Table -->
    @if($beban->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Nama Beban</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($beban as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                    <td>{{ $item->nama_beban }}</td>
                    <td>{{ 'Rp ' . number_format($item->nominal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <p>Belum ada data beban operasional. <a href="{{ route('beban.create') }}" class="btn-tambah" style="margin-top: 15px;">Tambah Beban Sekarang</a></p>
        </div>
    @endif
</div>

<!-- SCRIPT BENIH KECIL -->
<script>
    const container = document.getElementById('seedParticles');

    for (let i = 0; i < 45; i++) {
        let seed = document.createElement('div');
        seed.classList.add('seed-particle');

        let size = Math.random() * 6 + 3;
        let offsetX = (Math.random() * 420) - 210;
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