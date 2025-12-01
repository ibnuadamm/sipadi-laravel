@extends('layouts.app')

@section('content')
<h2>Tambah Persediaan</h2>

@if($errors->any())
    <ul style="color:red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('persediaan.store') }}" method="POST">
    @csrf
    <label>Kategori:</label><br>
    <input type="text" name="kategori" required><br><br>

    <label>Nama Barang:</label><br>
    <input type="text" name="nama_barang" required><br><br>

    <label>Stok Awal:</label><br>
    <input type="number" name="stok_awal" required><br><br>

    <label>Satuan:</label><br>
    <input type="text" name="satuan" required><br><br>

    <button type="submit">Simpan</button>
</form>
<a href="{{ route('persediaan.index') }}">Kembali</a>
@endsection
