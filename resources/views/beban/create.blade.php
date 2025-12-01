@extends('layouts.app')

@section('content')
<h1>Tambah Data Beban</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('beban.store') }}" method="POST">
    @csrf

    <label>Tanggal</label>
    <input type="date" name="tanggal" value="{{ old('tanggal') }}" required>
    <br>

    <label>Nama Beban</label>
    <input type="text" name="nama_beban" value="{{ old('nama_beban') }}" required>
    <br>

    <label>Nominal</label>
    <input type="number" name="nominal" value="{{ old('nominal') }}" required>
    <br><br>

    <button type="submit">Simpan</button>
</form>
@endsection
