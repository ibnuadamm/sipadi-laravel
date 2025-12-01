@extends('layouts.app')

@section('content')
<h2>Master Data Persediaan</h2>

{{-- Form filter kategori --}}
<form method="GET" action="{{ route('persediaan.index') }}">
    <label>Filter Kategori:</label>
    <select name="kategori" onchange="this.form.submit()">
        <option value="">-- Semua Kategori --</option>
        @foreach($kategoriList as $kategori)
            <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                {{ $kategori }}
            </option>
        @endforeach
    </select>
</form>
<br>

<a href="{{ route('persediaan.create') }}">Tambah Persediaan</a>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Kategori</th>
        <th>Nama Barang</th>
        <th>Stok Awal</th>
        <th>Satuan</th>
        <th>Stok Berjalan</th>
        <th>Aksi</th>
    </tr>
    @foreach($persediaan as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->kategori }}</td>
        <td>{{ $item->nama_barang }}</td>
        <td>{{ $item->stok_awal }}</td>
        <td>{{ $item->satuan }}</td>
        <td>{{ $item->stok_berjalan ?? 0 }}</td>
        <td>
            <a href="{{ route('persediaan.edit', $item->id) }}">Edit</a>
            <form action="{{ route('persediaan.destroy', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
