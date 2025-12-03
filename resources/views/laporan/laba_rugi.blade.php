@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Laporan Laba Rugi</h2>

    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-2">
                <select name="bulan" class="form-control">
                    <option value="all" {{ $bulan == 'all' ? 'selected' : '' }}>Semua Bulan</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-2">
                <select name="tahun" class="form-control">
                    <option value="all" {{ $tahun == 'all' ? 'selected' : '' }}>Semua Tahun</option>
                    @for ($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- ===================== RINGKASAN ===================== -->
    <table class="table table-bordered mb-5">
        <thead class="table-light">
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
            <tr class="table-secondary">
                <th><strong>Laba / Rugi Bersih</strong></th>
                <th class="text-end">{{ number_format($labaRugi, 2, ',', '.') }}</th>
            </tr>
        </tbody>
    </table>

    <!-- ===================== DETAIL PENJUALAN ===================== -->
    <h4>Detail Penjualan</h4>
    <table class="table table-striped mb-5">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($detailPenjualan as $p)
                <tr>
                    <td>{{ $p->tanggal }}</td>
                    <td>{{ $p->persediaan->nama_barang }}</td>
                    <td>{{ $p->qty }}</td>
                    <td>{{ number_format($p->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ number_format($p->subtotal, 0, ',', '.') }}</td>
                    <td>{{ $p->keterangan }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Tidak ada data penjualan</td></tr>
            @endforelse
        </tbody>
    </table>

    <!-- ===================== DETAIL PEMBELIAN ===================== -->
    <h4>Detail Pembelian</h4>
    <table class="table table-striped mb-5">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Bahan / Produk</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Total (qty × harga)</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($detailPembelian as $b)
                <tr>
                    <td>{{ $b->tanggal }}</td>
                    <td>{{ $b->persediaan->nama_barang }}</td>
                    <td>{{ $b->qty }}</td>
                    <td>{{ number_format($b->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ number_format($b->qty * $b->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $b->keterangan }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Tidak ada data pembelian</td></tr>
            @endforelse
        </tbody>
    </table>

    <!-- ===================== DETAIL BEBAN ===================== -->
    <h4>Detail Beban</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Beban</th>
                <th>Nominal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($detailBeban as $bb)
                <tr>
                    <td>{{ $bb->tanggal }}</td>
                    <td>{{ $bb->nama_beban }}</td>
                    <td>{{ number_format($bb->nominal, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">Tidak ada data beban</td></tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
