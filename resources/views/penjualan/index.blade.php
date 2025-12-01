@extends('layouts.app')

@section('content')
<h1>Data Penjualan</h1>

<a href="{{ route('penjualan.create') }}">Tambah Penjualan</a>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Barang</th>
        <th>Jumlah (Qty)</th>
        <th>Harga Satuan</th>
        <th>Subtotal</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Aksi</th>
    </tr>
    @foreach($penjualan as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->persediaan->nama_barang }}</td>
        <td>{{ $item->qty }}</td>
        <td>{{'Rp ' . number_format($item->harga_satuan, 0, ',', '.') }}</td>
        <td>{{'Rp ' . number_format($item->subtotal, 0, ',', '.') }}</td>
        <td>{{ $item->tanggal->format('d-m-Y') }}</td>
        <td>{{ $item->keterangan }}</td>
        <td>
            <a href="{{ route('penjualan.edit', $item->id) }}">Edit</a>
            <form action="{{ route('penjualan.destroy', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
