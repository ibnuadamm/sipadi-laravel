@extends('layouts.app')

@section('content')
<h1>Data Pemantauan</h1>

<a href="{{ route('pemantauan.create') }}">Tambah Pemantauan</a>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nama Bibit</th>
        <th>Lahan</th>
        <th>Tanggal Tanam</th>
        <th>Jumlah Ditanam</th>
        <th>Tanggal Panen</th>
        <th>Jumlah Panen</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($pemantauan as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->persediaan->nama_barang }}</td>
        <td>{{ $item->lahan ?? '-' }}</td>
        <td>{{ $item->tanggal_tanam->format('d-m-Y') }}</td>
        <td>{{ $item->jumlah_tanam }}</td>
        <td>{{ $item->tanggal_panen?->format('d-m-Y') ?? '-' }}</td>
        <td>{{ $item->jumlah_panen ?? '-' }}</td>

        <td>
            @if($item->status == 'Sudah Dipanen')
                <span style="color:green; font-weight:bold;">Sudah Dipanen</span>
            @else
                <span style="color:orange; font-weight:bold;">Dalam Pemeliharaan</span>
            @endif
        </td>

        <td>
            <a href="{{ route('pemantauan.edit', $item->id) }}">Edit</a>

            <form action="{{ route('pemantauan.destroy', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
