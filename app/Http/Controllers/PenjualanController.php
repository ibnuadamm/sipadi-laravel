<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Persediaan;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::with('persediaan')->get();
        return view('penjualan.index', compact('penjualan'));
    }

    public function create()
    {
        $persediaan = Persediaan::all();
        return view('penjualan.create', compact('persediaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persediaan_id' => 'required|exists:persediaan,id',
            'qty' => 'required|integer',
            'harga_satuan' => 'required|integer',
            'tanggal' => 'required|date',
        ]);

        // Hitung subtotal otomatis
        $subtotal = $request->qty * $request->harga_satuan;

        Penjualan::create([
            'persediaan_id' => $request->persediaan_id,
            'qty' => $request->qty,
            'harga_satuan' => $request->harga_satuan,
            'subtotal' => $subtotal,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil ditambahkan.');
    }

    public function edit(Penjualan $penjualan)
    {
        $persediaan = Persediaan::all();
        return view('penjualan.edit', compact('penjualan', 'persediaan'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'persediaan_id' => 'required|exists:persediaan,id',
            'qty' => 'required|integer',
            'harga_satuan' => 'required|integer',
            'tanggal' => 'required|date',
        ]);

        // Hitung subtotal otomatis saat update
        $subtotal = $request->qty * $request->harga_satuan;

        $penjualan->update([
            'persediaan_id' => $request->persediaan_id,
            'qty' => $request->qty,
            'harga_satuan' => $request->harga_satuan,
            'subtotal' => $subtotal,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil diupdate.');
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return redirect()->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil dihapus.');
    }
}
