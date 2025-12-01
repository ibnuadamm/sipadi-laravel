<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemantauanController;
use App\Http\Controllers\BebanController;
use App\Http\Controllers\LaporanLabaRugiController;
use App\Http\Controllers\LaporanBiayaProduksiController;
use App\Http\Controllers\PrediksiHargaController;

Route::get('/prediksi-harga', [PrediksiHargaController::class, 'index'])->name('prediksi.index');
Route::post('/prediksi-harga', [PrediksiHargaController::class, 'predict'])->name('prediksi.predict');

Route::get('/laporan/biaya-produksi', [LaporanBiayaProduksiController::class, 'index'])
    ->name('laporan.biaya_produksi');

Route::get('/laporan/laba_rugi', [LaporanLabaRugiController::class, 'index'])->name('laporan.laba_rugi');


// Beban
Route::resource('beban', BebanController::class);

// pemantauan
Route::resource('pemantauan', PemantauanController::class);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Persediaan
Route::resource('persediaan', PersediaanController::class);

// Pembelian
Route::resource('pembelian', PembelianController::class);

// Penjualan
Route::resource('penjualan', PenjualanController::class);