@extends('layouts.app')

@section('content')
<h1>Laporan Biaya Produksi</h1>

<form action="{{ route('laporan.biaya_produksi') }}" method="GET" style="margin-bottom:20px;">
    
    <label>Bulan:</label>
    <select name="bulan">
        <option value="">-- Semua --</option>
        @for ($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
            </option>
        @endfor
    </select>

    <label style="margin-left:20px;">Tahun:</label>
    <select name="tahun">
        <option value="">-- Semua --</option>
        @for ($t = 2023; $t <= now()->year; $t++)
            <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>{{ $t }}</option>
        @endfor
    </select>

    <button type="submit" style="margin-left:20px;">Filter</button>
</form>


<!-- ===================== -->
<!-- DETAIL PEMBELIAN -->
<!-- ===================== -->
<h2>Biaya Bahan Baku (Pembelian)</h2>

<table border="1" cellpadding="10" style="margin-bottom:20px; width:100%;">
    <tr>
        <th>Tanggal</th>
        <th>Nama Barang</th>
        <th>Qty</th>
        <th>Harga Satuan</th>
        <th>Subtotal</th>
        <th>Keterangan</th>
    </tr>

    @forelse($pembelian as $item)
    <tr>
        <td>{{ $item->tanggal->format('d-m-Y') }}</td>
        <td>{{ $item->persediaan->nama_barang }}</td>
        <td>{{ $item->qty }}</td>
        <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
        <td>Rp {{ number_format($item->qty * $item->harga_satuan, 0, ',', '.') }}</td>
        <td>{{ $item->keterangan ?? '-' }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="6">Tidak ada pembelian.</td>
    </tr>
    @endforelse
</table>


<p><strong>Total Biaya Bahan Baku:</strong>  
   Rp {{ number_format($totalBahanBaku, 0, ',', '.') }}</p>

<hr>


<!-- ===================== -->
<!-- DETAIL BEBAN PRODUKSI -->
<!-- ===================== -->
<h2>Beban Produksi</h2>

<table border="1" cellpadding="10" style="margin-bottom:20px; width:100%;">
    <tr>
        <th>Tanggal</th>
        <th>Nama Beban</th>
        <th>Nominal</th>
    </tr>

    @forelse($beban as $b)
    <tr>
        <td>{{ $b->tanggal->format('d-m-Y') }}</td>
        <td>{{ $b->nama_beban }}</td>
        <td>Rp {{ number_format($b->nominal, 0, ',', '.') }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="3">Tidak ada data beban produksi.</td>
    </tr>
    @endforelse
</table>

<p><strong>Total Beban Produksi:</strong>  
   Rp {{ number_format($totalBebanProduksi, 0, ',', '.') }}</p>

<hr>

<!-- ===================== -->
<!-- TOTAL BIAYA PRODUKSI -->
<!-- ===================== -->
<h2>Total Biaya Produksi</h2>

<p style="font-size:18px; font-weight:bold;">
    Rp {{ number_format($totalBiayaProduksi, 0, ',', '.') }}
</p>

@endsection
