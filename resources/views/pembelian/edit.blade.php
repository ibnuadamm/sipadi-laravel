@extends('layouts.app')

@section('content')
<h1>Edit Pembelian</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Barang</label>
    <select name="persediaan_id" required>
        <option value="">-- Pilih Barang --</option>
        @foreach($persediaan as $item)
            <option value="{{ $item->id }}" {{ $pembelian->persediaan_id == $item->id ? 'selected' : '' }}>
                {{ $item->nama_barang }}
            </option>
        @endforeach
    </select>
    <br>

    <label>Jumlah (Qty)</label>
    <input type="number" name="qty" value="{{ $pembelian->qty }}" required>
    <br>

    <label>Harga Satuan</label>
    <input type="number" name="harga_satuan" value="{{ $pembelian->harga_satuan }}" required>
    <br>

    <label>Tanggal</label>
    <input type="date" name="tanggal" value="{{ $pembelian->tanggal->format('Y-m-d') }}" required>
    <br>

    <label>Keterangan</label>
    <input type="text" name="keterangan" value="{{ $pembelian->keterangan }}">
    <br><br>

    <button type="submit">Update</button>
</form>
@endsection
