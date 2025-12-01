@extends('layouts.app')

@section('content')
<h1>Data Beban Operasional</h1>

<a href="{{ route('beban.create') }}">Tambah Beban</a>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@php
    $namaBulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei',
        6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September',
        10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];
@endphp

<h3>Filter Beban</h3>

<form method="GET" action="{{ route('beban.index') }}">
    <select name="month">
        <option value="">-- Bulan --</option>
        @foreach($namaBulan as $num => $nama)
            <option value="{{ $num }}" {{ (isset($month) && $month == $num) ? 'selected' : '' }}>
                {{ $nama }}
            </option>
        @endforeach
    </select>

    <select name="year">
        <option value="">-- Tahun --</option>
        @for($i = 2023; $i <= date('Y'); $i++)
            <option value="{{ $i }}" {{ (isset($year) && $year == $i) ? 'selected' : '' }}>
                {{ $i }}
            </option>
        @endfor
    </select>

    <button type="submit">Filter</button>
</form>

<br>

{{-- Total beban berdasarkan filter --}}
@if(isset($month) && isset($year) && $month && $year)
    <h3>Total beban di bulan {{ $namaBulan[$month] }} {{ $year }} sebesar 
        <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
    </h3>
@elseif(isset($year) && $year)
    <h3>Total beban di tahun {{ $year }} sebesar 
        <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
    </h3>
@endif

<br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Nama Beban</th>
        <th>Nominal</th>
        <th>Aksi</th>
    </tr>

    @foreach($beban as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->tanggal->format('d-m-Y') }}</td>
        <td>{{ $item->nama_beban }}</td>
        <td>{{ 'Rp ' . number_format($item->nominal, 0, ',', '.') }}</td>
        <td>
            <a href="{{ route('beban.edit', $item->id) }}">Edit</a>

            <form action="{{ route('beban.destroy', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Yakin ingin hapus?')" type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
