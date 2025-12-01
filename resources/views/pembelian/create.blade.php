@extends('layouts.app')

@section('content')
<h1>Tambah Pembelian</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('pembelian.store') }}" method="POST">
    @csrf

    <label>Barang</label>
    <select name="persediaan_id" required>
        <option value="">-- Pilih Barang --</option>
        @foreach($persediaan as $item)
            <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
        @endforeach
    </select>
    <br>

    <label>Jumlah (Qty)</label>
    <input type="number" name="qty" value="{{ old('qty') }}" required>
    <br>

    <label>Harga Satuan</label>
    <input type="number" name="harga_satuan" value="{{ old('harga_satuan') }}" required>
    <br>

    <label>Tanggal</label>
    <input type="date" name="tanggal" value="{{ old('tanggal') }}" required>
    <br>

    <label>Keterangan</label>
    <input type="text" name="keterangan" value="{{ old('keterangan') }}">
    <br><br>

    <button type="submit">Simpan</button>
</form>
@endsection
