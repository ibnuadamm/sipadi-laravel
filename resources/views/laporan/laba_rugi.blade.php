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
        DASHBOARD CONTAINER
    ================================================================ */
    .dashboard-container {
        position: relative;
        z-index: 5;
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Title */
    h2 {
        color: white;
        font-size: 28px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        margin-bottom: 30px;
        text-align: center;
    }

    h4 {
        color: white;
        font-size: 16px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        margin: 25px 0 15px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Filter Section */
    .filter-section {
        background: rgba(255, 255, 255, 0.2);
        padding: 20px;
        border-radius: 12px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        margin-bottom: 30px;
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

    .filter-form select {
        min-width: 150px;
    }

    .filter-form select:hover,
    .filter-form select:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
        outline: none;
    }

    .filter-form button {
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        border: none;
    }

    .filter-form button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
    }

    .filter-form select option {
        background: #36574aff;
        color: white;
    }

    /* Summary Table */
    .summary-table {
        width: 100%;
        border-collapse: collapse;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 10px;
        overflow: hidden;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 30px;
    }

    .summary-table thead {
        background: rgba(255, 255, 255, 0.2);
    }

    .summary-table th {
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .summary-table td {
        padding: 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 14px;
        font-weight: 500;
    }

    .summary-table tr:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .summary-table tr:last-child td {
        border-bottom: none;
    }

    .summary-table .summary-row {
        background: rgba(76, 175, 80, 0.2);
        font-weight: 700;
    }

    .summary-table .text-end {
        text-align: right;
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
        margin-bottom: 30px;
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
        font-weight: 500;
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

    /* Responsive */
    @media (max-width: 768px) {
        .navbar-menu-items {
            gap: 4px;
        }

        .navbar-menu-items a {
            padding: 4px 8px;
            font-size: 11px;
        }

        h2 {
            font-size: 20px;
        }

        .filter-form {
            flex-direction: column;
        }

        .filter-form select,
        .filter-form button {
            width: 100%;
        }

        .summary-table,
        .detail-table {
            font-size: 12px;
        }

        .summary-table th,
        .summary-table td,
        .detail-table th,
        .detail-table td {
            padding: 8px 10px;
        }
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<nav class="navbar-simple">
    <div class="navbar-logo-section">
        <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
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
    <h2><i class="bi bi-graph-up-arrow"></i> Laporan Laba Rugi</h2>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" class="filter-form">
            <select name="bulan">
                <option value="all" {{ $bulan == 'all' ? 'selected' : '' }}>Semua Bulan</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>

            <select name="tahun">
                <option value="all" {{ $tahun == 'all' ? 'selected' : '' }}>Semua Tahun</option>
                @for ($y = date('Y'); $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>

            <button type="submit"><i class="bi bi-funnel"></i> Filter</button>
        </form>
    </div>

    <!-- RINGKASAN TABLE -->
    <table class="summary-table">
        <thead>
            <tr>
                <th>Keterangan</th>
                <th class="text-end">Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Total Penjualan</strong></td>
                <td class="text-end">{{ number_format($totalPenjualan, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Total Pembelian / HPP</strong></td>
                <td class="text-end">{{ number_format($totalPembelian, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Total Beban</strong></td>
                <td class="text-end">{{ number_format($totalBeban, 2, ',', '.') }}</td>
            </tr>
            <tr class="summary-row">
                <td><strong>Laba / Rugi Bersih</strong></td>
                <td class="text-end">{{ number_format($labaRugi, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- DETAIL PENJUALAN -->
    <h4><i class="bi bi-bag-check"></i> Detail Penjualan</h4>
    <table class="detail-table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Qty</th>
                <th class="text-end">Harga Satuan</th>
                <th class="text-end">Subtotal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($detailPenjualan as $p)
                <tr>
                    <td>{{ $p->tanggal->format('d-m-Y') }}</td>
                    <td>{{ $p->persediaan->nama_barang }}</td>
                    <td>{{ $p->qty }}</td>
                    <td class="text-end">{{ number_format($p->harga_satuan, 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($p->subtotal, 0, ',', '.') }}</td>
                    <td>{{ $p->keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-message">Tidak ada data penjualan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- DETAIL PEMBELIAN -->
    <h4><i class="bi bi-cart-plus"></i> Detail Pembelian</h4>
    <table class="detail-table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Bahan / Produk</th>
                <th>Qty</th>
                <th class="text-end">Harga Satuan</th>
                <th class="text-end">Total (qty × harga)</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($detailPembelian as $b)
                <tr>
                    <td>{{ $b->tanggal->format('d-m-Y') }}</td>
                    <td>{{ $b->persediaan->nama_barang }}</td>
                    <td>{{ $b->qty }}</td>
                    <td class="text-end">{{ number_format($b->harga_satuan, 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($b->qty * $b->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $b->keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-message">Tidak ada data pembelian</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- DETAIL BEBAN -->
    <h4><i class="bi bi-wallet2"></i> Detail Beban</h4>
    <table class="detail-table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Beban</th>
                <th class="text-end">Nominal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($detailBeban as $bb)
                <tr>
                    <td>{{ $bb->tanggal->format('d-m-Y') }}</td>
                    <td>{{ $bb->nama_beban }}</td>
                    <td class="text-end">{{ number_format($bb->nominal, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="empty-message">Tidak ada data beban</td>
                </tr>
            @endforelse
        </tbody>
    </table>
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