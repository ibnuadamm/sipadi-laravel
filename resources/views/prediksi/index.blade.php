@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Prediksi Harga Jual Bibit</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('prediksi.predict') }}">
        @csrf
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Produk / Bibit</label>
            <input type="text" name="produk" class="form-control" required>
        </div>
        <button class="btn btn-primary">Prediksi Harga</button>
    </form>

    @isset($hargaPrediksi)
        <div class="mt-4 alert alert-success">
            Prediksi harga jual untuk <b>{{ $produk }}</b> di <b>{{ $lokasi }}</b> adalah: 
            <b>Rp {{ number_format($hargaPrediksi, 2, ',', '.') }}</b>
        </div>
    @endisset
</div>
@endsection
