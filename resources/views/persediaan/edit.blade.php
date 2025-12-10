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
        max-width: 800px;
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
        gap: 15px;
    }

    h2 {
        color: white;
        font-size: 28px;
        margin: 0;
        font-weight: 700;
    }

    /* Back Button */
    .btn-back {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid rgba(255, 255, 255, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    /* Form Card */
    .form-card {
        background: rgba(255, 255, 255, 0.15);
        padding: 30px;
        border-radius: 12px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Alert Error */
    .alert-error {
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

    .alert-error ul {
        margin: 10px 0 0 0;
        padding-left: 20px;
    }

    .alert-error li {
        margin: 5px 0;
        list-style: disc;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 25px;
        display: flex;
        flex-direction: column;
    }

    .form-group:last-of-type {
        margin-bottom: 0;
    }

    .form-group label {
        color: white;
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-group label i {
        font-size: 14px;
    }

    .form-group input {
        padding: 12px 15px;
        border-radius: 6px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 14px;
        transition: all 0.2s ease;
        font-family: Arial, sans-serif;
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

    /* Button Group */
    .button-group {
        display: flex;
        gap: 12px;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    /* Submit Button */
    .btn-submit {
        background: linear-gradient(135deg, #6f835bff 0%, #36574aff 100%);
        color: white;
        padding: 12px 28px;
        border-radius: 6px;
        border: none;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        flex: 1;
        justify-content: center;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(111, 131, 91, 0.3);
    }

    .btn-submit i {
        font-size: 16px;
    }

    /* Cancel Button */
    .btn-cancel {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        padding: 12px 28px;
        border-radius: 6px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        flex: 1;
        justify-content: center;
    }

    .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .btn-cancel i {
        font-size: 16px;
    }

    /* Error Message */
    .error-message {
        color: #FFB3BA;
        font-size: 12px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Info Box */
    .info-box {
        background: rgba(111, 131, 91, 0.15);
        border-left: 4px solid rgba(111, 131, 91, 0.8);
        color: rgba(255, 255, 255, 0.9);
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 8px;
        border: 1px solid rgba(111, 131, 91, 0.3);
    }

    .info-box i {
        font-size: 16px;
        flex-shrink: 0;
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

        .dashboard-container {
            max-width: 100%;
        }

        .form-card {
            padding: 20px;
        }

        .button-group {
            flex-direction: column;
        }

        .btn-submit,
        .btn-cancel {
            flex: 1;
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
    <!-- Header Section -->
    <div class="header-section">
        <h2><i class="bi bi-pencil-square"></i> Edit Persediaan</h2>
        <a href="{{ route('persediaan.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <!-- Info Box -->
        <div class="info-box">
            <i class="bi bi-info-circle"></i>
            <span>ID Persediaan: <strong>#{{ $persediaan->id }}</strong></span>
        </div>

        <!-- Alert Error -->
        @if($errors->any())
            <div class="alert-error">
                <strong><i class="bi bi-exclamation-circle"></i> Terjadi Kesalahan:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('persediaan.update', $persediaan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Kategori Field -->
            <div class="form-group">
                <label for="kategori">
                    <i class="bi bi-tags"></i> Kategori
                </label>
                <input type="text" id="kategori" name="kategori" 
                    value="{{ old('kategori', $persediaan->kategori) }}"
                    placeholder="Contoh: Sayuran, Buah, Benih" required>
                @if ($errors->has('kategori'))
                    <span class="error-message">
                        <i class="bi bi-exclamation-circle"></i> {{ $errors->first('kategori') }}
                    </span>
                @endif
            </div>

            <!-- Nama Barang Field -->
            <div class="form-group">
                <label for="nama_barang">
                    <i class="bi bi-box-seam"></i> Nama Barang
                </label>
                <input type="text" id="nama_barang" name="nama_barang" 
                    value="{{ old('nama_barang', $persediaan->nama_barang) }}"
                    placeholder="Contoh: Cabai Rawit, Tomat, Benih Jagung" required>
                @if ($errors->has('nama_barang'))
                    <span class="error-message">
                        <i class="bi bi-exclamation-circle"></i> {{ $errors->first('nama_barang') }}
                    </span>
                @endif
            </div>

            <!-- Stok Awal Field -->
            <div class="form-group">
                <label for="stok_awal">
                    <i class="bi bi-bag-plus"></i> Stok Awal
                </label>
                <input type="number" id="stok_awal" name="stok_awal" 
                    value="{{ old('stok_awal', $persediaan->stok_awal) }}"
                    placeholder="Contoh: 100" required>
                @if ($errors->has('stok_awal'))
                    <span class="error-message">
                        <i class="bi bi-exclamation-circle"></i> {{ $errors->first('stok_awal') }}
                    </span>
                @endif
            </div>

            <!-- Satuan Field -->
            <div class="form-group">
                <label for="satuan">
                    <i class="bi bi-rulers"></i> Satuan
                </label>
                <input type="text" id="satuan" name="satuan" 
                    value="{{ old('satuan', $persediaan->satuan) }}"
                    placeholder="Contoh: Kg, Gram, Liter, Pcs" required>
                @if ($errors->has('satuan'))
                    <span class="error-message">
                        <i class="bi bi-exclamation-circle"></i> {{ $errors->first('satuan') }}
                    </span>
                @endif
            </div>

            <!-- Button Group -->
            <div class="button-group">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-arrow-repeat"></i> Update
                </button>
                <a href="{{ route('persediaan.index') }}" class="btn-cancel">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
            </div>
        </form>
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