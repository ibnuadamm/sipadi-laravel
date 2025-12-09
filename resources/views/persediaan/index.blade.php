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

    /* Header Section dengan Title dan Button */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
    }

    h2 {
        color: white;
        font-size: 24px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Filter Form */
    .filter-form {
        background: rgba(255, 255, 255, 0.15);
        padding: 12px 18px;
        border-radius: 8px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .filter-form label {
        color: white;
        font-size: 13px;
        font-weight: 500;
        white-space: nowrap;
    }

    .filter-form select {
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .filter-form select:hover,
    .filter-form select:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
        outline: none;
    }

    .filter-form select option {
        background: #2d5a3d;
        color: white;
    }

    /* Tambah Button */
    .btn-tambah {
        background: linear-gradient(135deg, #4CAF50 0%, #388E3C 100%);
        color: white;
        padding: 8px 18px;
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
        box-shadow: 0 6px 20px rgba(76, 175, 80, 0.3);
    }

    /* Alert Success */
    .alert-success {
        background: rgba(76, 175, 80, 0.25);
        border-left: 4px solid #4CAF50;
        color: white;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(76, 175, 80, 0.3);
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
        font-size: 13px;
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

    /* Action Buttons */
    .btn-action {
        padding: 6px 12px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        font-size: 12px;
        font-weight: 500;
        margin-right: 6px;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-edit {
        background: rgba(33, 150, 243, 0.8);
        color: white;
    }

    .btn-edit:hover {
        background: rgba(33, 150, 243, 1);
        transform: translateY(-1px);
    }

    .btn-hapus {
        background: rgba(229, 57, 53, 0.8);
        color: white;
    }

    .btn-hapus:hover {
        background: rgba(229, 57, 53, 1);
        transform: translateY(-1px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: rgba(255, 255, 255, 0.7);
        font-size: 16px;
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

<div class="dashboard-container">
    <!-- Header Section dengan Title dan Actions -->
    <div class="header-section">
        <h2>Master Data Persediaan</h2>
        <div class="header-actions">
            <!-- Filter Kategori Form -->
            <form method="GET" action="{{ route('persediaan.index') }}" class="filter-form">
                <label for="kategori-filter">Filter Kategori:</label>
                <select name="kategori" id="kategori-filter" onchange="this.form.submit()">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($kategoriList as $kategori)
                        <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
            </form>

            <!-- Tambah Persediaan Button -->
            <a href="{{ route('persediaan.create') }}" class="btn-tambah">
                <i class="bi bi-plus-circle"></i> Tambah Persediaan
            </a>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert-success">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Data Table -->
    @if($persediaan->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kategori</th>
                    <th>Nama Barang</th>
                    <th>Stok Awal</th>
                    <th>Satuan</th>
                    <th>Stok Berjalan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($persediaan as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->stok_awal }}</td>
                    <td>{{ $item->satuan }}</td>
                    <td>{{ $item->stok_berjalan ?? 0 }}</td>
                    <td>
                        <a href="{{ route('persediaan.edit', $item->id) }}" class="btn-action btn-edit">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('persediaan.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-hapus" onclick="return confirm('Yakin ingin hapus data ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <i class="bi bi-inbox" style="font-size: 48px; margin-bottom: 15px; display: block;"></i>
            <p>Belum ada data persediaan. <a href="{{ route('persediaan.create') }}" class="btn-tambah" style="margin-top: 15px;">Tambah Persediaan Sekarang</a></p>
        </div>
    @endif
</div>

@endsection