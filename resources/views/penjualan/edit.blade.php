@extends('layouts.app')

@section('content')
<h1>Edit Penjualan</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Barang</label>
    <select name="persediaan_id" required>
        <option value="">-- Pilih Barang --</option>
        @foreach($persediaan as $item)
            <option value="{{ $item->id }}" {{ $penjualan->persediaan_id == $item->id ? 'selected' : '' }}>
                {{ $item->nama_barang }}
            </option>
        @endforeach
    </select>
    <br>

    <label>Jumlah (Qty)</label>
    <input type="number" name="qty" value="{{ $penjualan->qty }}" required>
    <br>

    <label>Harga Satuan</label>
    <input type="number" name="harga_satuan" value="{{ $penjualan->harga_satuan }}" required>
    <br>

    <label>Keterangan</label>
    <textarea name="keterangan">{{ $penjualan->keterangan }}</textarea>
    <br>

    <label>Tanggal</label>
    <input type="date" name="tanggal" value="{{ \Carbon\Carbon::parse($penjualan->tanggal)->format('Y-m-d') }}" required>
    <br><br>

    <button type="submit">Update</button>
</form>
@endsection
