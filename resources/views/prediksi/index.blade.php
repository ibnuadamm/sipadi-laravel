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
        max-width: 1000px;
        margin: 0 auto;
        padding: 40px 20px 100px 20px;
    }

    h2 {
        color: white;
        font-size: 28px;
        margin-bottom: 30px;
        text-align: center;
        font-weight: 700;
    }

    h4 {
        color: white;
        font-size: 16px;
        margin-bottom: 15px;
        font-weight: 700;
    }

    /* Alert */
    .alert-danger {
        background: rgba(229, 57, 53, 0.2);
        border-left: 4px solid rgba(229, 57, 53, 0.8);
        color: white;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(229, 57, 53, 0.3);
    }

    /* Prediction Card */
    .prediction-card {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        padding: 28px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 25px;
    }

    /* Form Styles */
    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        color: white;
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-group input {
        padding: 12px 15px;
        border-radius: 6px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .form-group input:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
        outline: none;
        box-shadow: 0 0 0 3px rgba(111, 131, 91, 0.2);
    }

    .form-group input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    /* Button */
    .btn-predict {
        background: linear-gradient(135deg, #6f835bff 0%, #36574aff 100%);
        color: white;
        padding: 14px 28px;
        border-radius: 6px;
        border: none;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 10px;
    }

    .btn-predict:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(111, 131, 91, 0.3);
    }

    .btn-predict i {
        font-size: 16px;
    }

    /* AI Output Box */
    .ai-output-box {
        background: rgba(255, 255, 255, 0.08);
        border-left: 5px solid rgba(111, 131, 91, 0.8);
        padding: 20px;
        border-radius: 8px;
        white-space: pre-wrap;
        word-wrap: break-word;
        font-size: 14px;
        line-height: 1.6;
        font-family: "Courier New", monospace;
        color: white;
        overflow-x: auto;
        margin-top: 15px;
        border: 1px solid rgba(111, 131, 91, 0.2);
    }

    /* Result Info */
    .result-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .result-info-item {
        padding: 12px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .result-info-item strong {
        color: rgba(255, 255, 255, 0.8);
        display: block;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .result-info-item span {
        color: white;
        font-size: 16px;
        font-weight: 600;
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

        .prediction-card {
            padding: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .ai-output-box {
            font-size: 12px;
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
    <h2><i class="bi bi-robot"></i> Prediksi Harga Produk Pertanian</h2>

    <!-- Alert Error -->
    @if(session('error'))
        <div class="alert-danger">
            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Prediction Form Card -->
    <div class="prediction-card">
        <form method="POST" action="{{ route('prediksi.predict') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="lokasi"><i class="bi bi-geo-alt"></i> Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" 
                        placeholder="Contoh: Bandung, Jakarta, Surabaya" required>
                </div>

                <div class="form-group">
                    <label for="produk"><i class="bi bi-leaf"></i> Produk</label>
                    <input type="text" id="produk" name="produk" 
                        placeholder="Contoh: Cabai, Jagung, Tomat" required>
                </div>
            </div>

            <button type="submit" class="btn-predict">
                <i class="bi bi-search"></i> Prediksi Harga dengan AI
            </button>
        </form>
    </div>

    <!-- Prediction Result Card -->
    @isset($hasil)
        <div class="prediction-card">
            <h4><i class="bi bi-bar-chart"></i> Hasil Prediksi AI</h4>

            <div class="result-info">
                <div class="result-info-item">
                    <strong><i class="bi bi-leaf"></i> Produk</strong>
                    <span>{{ $produk }}</span>
                </div>
                <div class="result-info-item">
                    <strong><i class="bi bi-geo-alt"></i> Lokasi</strong>
                    <span>{{ $lokasi }}</span>
                </div>
            </div>

            <div class="ai-output-box">{{ $hasil }}</div>
        </div>
    @endisset
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