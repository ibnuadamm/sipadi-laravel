@extends('layouts.app')

@section('content')
<h1>Edit Data Beban</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('beban.update', $beban->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Tanggal</label>
    <input type="date" name="tanggal" value="{{ $beban->tanggal->format('Y-m-d') }}" required>
    <br>

    <label>Nama Beban</label>
    <input type="text" name="nama_beban" value="{{ $beban->nama_beban }}" required>
    <br>

    <label>Nominal</label>
    <input type="number" name="nominal" value="{{ $beban->nominal }}" required>
    <br><br>

    <button type="submit">Update</button>
</form>
@endsection
