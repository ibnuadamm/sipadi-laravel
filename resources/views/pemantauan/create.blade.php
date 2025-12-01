@extends('layouts.app')

@section('content')
<h1>Tambah Pemantauan Tanam</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('pemantauan.store') }}" method="POST">
    @csrf

    <label>Nama Bibit</label>
    <select name="persediaan_id" required>
        <option value="">-- Pilih Bibit --</option>
        @foreach($persediaan as $item)
            <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
        @endforeach
    </select>
    <br>

    <label>Lahan</label>
    <input type="text" name="lahan" placeholder="Contoh: Lahan A / Lahan 1">
    <br>

    <label>Tanggal Tanam</label>
    <input type="date" name="tanggal_tanam" required>
    <br>

    <label>Jumlah Ditanam</label>
    <input type="number" name="jumlah_tanam" min="1" required>
    <br><br>

    <button type="submit">Simpan</button>
</form>
@endsection
