@extends('layouts.app')

@section('content')
<h2>Edit Persediaan</h2>

@if($errors->any())
    <ul style="color:red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('persediaan.update', $persediaan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Kategori:</label><br>
    <input type="text" name="kategori" value="{{ $persediaan->kategori }}" required><br><br>

    <label>Nama Barang:</label><br>
    <input type="text" name="nama_barang" value="{{ $persediaan->nama_barang }}" required><br><br>

    <label>Stok Awal:</label><br>
    <input type="number" name="stok_awal" value="{{ $persediaan->stok_awal }}" required><br><br>

    <label>Satuan:</label><br>
    <input type="text" name="satuan" value="{{ $persediaan->satuan }}" required><br><br>

    <button type="submit">Update</button>
</form>
<a href="{{ route('persediaan.index') }}">Kembali</a>
@endsection
