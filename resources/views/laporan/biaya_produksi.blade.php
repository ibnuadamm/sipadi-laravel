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

    /* Title */
    h1 {
        color: white;
        font-size: 28px;
        margin-bottom: 30px;
        text-align: center;
        font-weight: 700;
    }

    h2 {
        color: white;
        font-size: 18px;
        margin: 30px 0 20px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
    }

    /* Filter Section */
    .filter-section {
        background: rgba(255, 255, 255, 0.15);
        padding: 20px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 30px;
    }

    .filter-form {
        display: flex;
        gap: 15px;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .filter-form label {
        color: white;
        font-size: 13px;
        font-weight: 500;
        white-space: nowrap;
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

    .filter-form select {
        min-width: 150px;
        appearance: none;
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8"><path d="M1 1l5 5 5-5" stroke="rgba(255,255,255,0.6)" fill="none" stroke-width="2" stroke-linecap="round"/></svg>');
        background-repeat: no-repeat;
        background-position: right 8px center;
        padding-right: 30px;
    }

    .filter-form select:hover,
    .filter-form select:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
        outline: none;
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

    /* Detail Table */
    .detail-table {
        width: 100%;
        border-collapse: collapse;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 10px;
        overflow: hidden;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 20px;
    }

    .detail-table thead {
        background: rgba(255, 255, 255, 0.2);
    }

    .detail-table th {
        color: white;
        padding: 12px 15px;
        text-align: left;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-table td {
        padding: 12px 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 13px;
    }

    .detail-table tr:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .detail-table tr:last-child td {
        border-bottom: none;
    }

    .detail-table .text-center {
        text-align: center;
    }

    .detail-table .text-end {
        text-align: right;
    }

    .empty-message {
        color: rgba(255, 255, 255, 0.7);
        text-align: center;
        padding: 20px;
    }

    /* Total Summary Card */
    .summary-card {
        background: rgba(255, 255, 255, 0.15);
        padding: 20px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 25px;
    }

    .summary-card label {
        color: rgba(255, 255, 255, 0.8);
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .summary-card .amount {
        font-size: 24px;
        font-weight: bold;
        color: #81C784;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Total Biaya Produksi - Highlight Card */
    .total-biaya-card {
        background: linear-gradient(135deg, rgba(111, 131, 91, 0.3) 0%, rgba(54, 87, 74, 0.3) 100%);
        padding: 30px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(111, 131, 91, 0.5);
        text-align: center;
        margin-top: 30px;
    }

    .total-biaya-card label {
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: block;
        margin-bottom: 12px;
        font-weight: 700;
    }

    .total-biaya-card .amount {
        font-size: 36px;
        font-weight: bold;
        color: #A5D6A7;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
    }

    /* Divider */
    .divider {
        border: none;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        margin: 30px 0;
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

        h2 {
            font-size: 14px;
        }

        .filter-form {
            flex-direction: column;
        }

        .filter-form label,
        .filter-form select,
        .filter-form button {
            width: 100%;
        }

        .filter-form select {
            min-width: auto;
        }

        .detail-table {
            font-size: 12px;
        }

        .detail-table th,
        .detail-table td {
            padding: 8px 10px;
        }

        .summary-card .amount {
            font-size: 18px;
        }

        .total-biaya-card .amount {
            font-size: 26px;
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
    <!-- Title -->
    <h1><i class="bi bi-calculator"></i> Laporan Biaya Produksi</h1>

    <!-- Filter Section -->
    <div class="filter-section">
        <form action="{{ route('laporan.biaya_produksi') }}" method="GET" class="filter-form">
            <label for="bulan">Bulan:</label>
            <select name="bulan" id="bulan">
                <option value="">-- Semua --</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                    </option>
                    @endfor
            </select>

            <label for="tahun">Tahun:</label>
            <select name="tahun" id="tahun">
                <option value="">-- Semua --</option>
                @for ($t = 2023; $t <= now()->year; $t++)
                    <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endfor
            </select>

            <button type="submit"><i class="bi bi-funnel"></i> Filter</button>
        </form>
    </div>

    <!-- BIAYA BAHAN BAKU SECTION -->
    <h2><i class="bi bi-box-seam"></i> Biaya Bahan Baku (Pembelian)</h2>

    <table class="detail-table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th class="text-end">Harga Satuan</th>
                <th class="text-end">Subtotal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pembelian as $item)
            <tr>
                <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                <td>{{ $item->persediaan->nama_barang }}</td>
                <td>{{ $item->qty }}</td>
                <td class="text-end">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($item->qty * $item->harga_satuan, 0, ',', '.') }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="empty-message">Tidak ada pembelian.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary-card">
        <label><i class="bi bi-calculator"></i> Total Biaya Bahan Baku</label>
        <div class="amount">Rp {{ number_format($totalBahanBaku, 0, ',', '.') }}</div>
    </div>

    <hr class="divider">

    <!-- BEBAN OPERASIONAL SECTION -->
    <h2><i class="bi bi-wallet2"></i> Beban Operasional</h2>

    <table class="detail-table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Beban</th>
                <th class="text-end">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($beban as $b)
            <tr>
                <td>{{ $b->tanggal->format('d-m-Y') }}</td>
                <td>{{ $b->nama_beban }}</td>
                <td class="text-end">Rp {{ number_format($b->nominal, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="empty-message">Tidak ada data beban produksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary-card">
        <label><i class="bi bi-calculator"></i> Total Beban Operasional</label>
        <div class="amount">Rp {{ number_format($totalBebanProduksi, 0, ',', '.') }}</div>
    </div>

    <hr class="divider">

    <!-- TOTAL BIAYA PRODUKSI -->
    <div class="total-biaya-card">
        <label><i class="bi bi-graph-up"></i> Total Biaya Produksi</label>
        <div class="amount">Rp {{ number_format($totalBiayaProduksi, 0, ',', '.') }}</div>
    </div>
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