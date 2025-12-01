@extends('layouts.app')

@section('content')
<h1>Edit Pemantauan</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('pemantauan.update', $pemantauan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Bibit</label>
    <select name="persediaan_id" required>
        @foreach($persediaan as $item)
            <option value="{{ $item->id }}" {{ $pemantauan->persediaan_id == $item->id ? 'selected' : '' }}>
                {{ $item->nama_barang }}
            </option>
        @endforeach
    </select>
    <br>

    <label>Lahan</label>
    <input type="text" name="lahan" value="{{ $pemantauan->lahan }}">
    <br>

    <label>Tanggal Tanam</label>
    <input type="date" name="tanggal_tanam" value="{{ $pemantauan->tanggal_tanam->format('Y-m-d') }}" required>
    <br>

    <label>Jumlah Ditanam</label>
    <input type="number" name="jumlah_tanam" value="{{ $pemantauan->jumlah_tanam }}" min="1" required>
    <br>

    <label>Tanggal Panen</label>
    <input type="date" name="tanggal_panen" value="{{ $pemantauan->tanggal_panen?->format('Y-m-d') }}">
    <br>

    <label>Jumlah Panen</label>
    <input type="number" name="jumlah_panen" value="{{ $pemantauan->jumlah_panen }}">
    <br><br>

    <button type="submit">Update</button>
</form>
@endsection
