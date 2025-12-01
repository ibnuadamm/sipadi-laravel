@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Laporan Laba Rugi</h2>

    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-2">
                <select name="bulan" class="form-control">
                    <option value="all" {{ $bulan == 'all' ? 'selected' : '' }}>Semua Bulan</option>
                    @for($i=1; $i<=12; $i++)
                        <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <select name="tahun" class="form-control">
                    <option value="all" {{ $tahun == 'all' ? 'selected' : '' }}>Semua Tahun</option>
                    @for($y=date('Y'); $y>=2020; $y--)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Keterangan</th>
                <th>Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Penjualan</td>
                <td>{{ number_format($totalPenjualan, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Pembelian / HPP</td>
                <td>{{ number_format($totalPembelian, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Beban</td>
                <td>{{ number_format($totalBeban, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Laba / Rugi Bersih</th>
                <th>{{ number_format($labaRugi, 2, ',', '.') }}</th>
            </tr>
        </tbody>
    </table>
</div>
@endsection
