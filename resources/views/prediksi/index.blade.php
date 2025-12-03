@extends('layouts.app')

@section('content')
<style>
    .prediction-card {
        border-radius: 16px;
        padding: 28px;
        background: #ffffff;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }
    .ai-output-box {
        background: #f8f9fa;
        border-left: 5px solid #0d6efd;
        padding: 20px;
        border-radius: 12px;
        white-space: pre-wrap;
        font-size: 15px;
        line-height: 1.5;
        font-family: "Courier New", monospace;
    }
    .page-title {
        font-weight: 700;
        font-size: 28px;
    }
</style>

<div class="container">

    <h2 class="page-title mb-4">
        🔮 Prediksi Harga Produk Pertanian (AI)
    </h2>

    <!-- ERROR -->
    @if(session('error'))
        <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif

    <div class="prediction-card mb-4">
        <form method="POST" action="{{ route('prediksi.predict') }}">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control form-control-lg"
                        placeholder="Contoh: Bandung, Jakarta, Surabaya" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Produk</label>
                    <input type="text" name="produk" class="form-control form-control-lg"
                        placeholder="Contoh: Cabai, Jagung, Tomat" required>
                </div>
            </div>

            <button class="btn btn-primary btn-lg w-100 mt-4 shadow-sm">
                🔍 Prediksi Harga dengan AI
            </button>
        </form>
    </div>

    @isset($hasil)
        <div class="prediction-card">
            <h4 class="fw-bold mb-3">📊 Hasil Prediksi AI</h4>

            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Produk:</strong> {{ $produk }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Lokasi:</strong> {{ $lokasi }}</p>
                </div>
            </div>

            <div class="ai-output-box mt-3">
                {{ $hasil }}
            </div>
        </div>
    @endisset

</div>
@endsection