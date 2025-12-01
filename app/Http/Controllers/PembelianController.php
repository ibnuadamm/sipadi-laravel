<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Persediaan;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelian = Pembelian::with('persediaan')->get();
        return view('pembelian.index', compact('pembelian'));
    }

    public function create()
    {
        $persediaan = Persediaan::all();
        return view('pembelian.create', compact('persediaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persediaan_id' => 'required|exists:persediaan,id',
            'qty' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:1',
            'tanggal' => 'required|date',
        ]);

        Pembelian::create($request->all());

        return redirect()->route('pembelian.index')->with('success', 'Data pembelian berhasil ditambahkan.');
    }

    public function edit(Pembelian $pembelian)
    {
        $persediaan = Persediaan::all();
        return view('pembelian.edit', compact('pembelian', 'persediaan'));
    }

    public function update(Request $request, Pembelian $pembelian)
    {
        $request->validate([
            'persediaan_id' => 'required|exists:persediaan,id',
            'qty' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:1',
            'tanggal' => 'required|date',
        ]);

        $pembelian->update($request->all());

        return redirect()->route('pembelian.index')->with('success', 'Data pembelian berhasil diupdate.');
    }

    public function destroy(Pembelian $pembelian)
    {
        $pembelian->delete();
        return redirect()->route('pembelian.index')->with('success', 'Data pembelian berhasil dihapus.');
    }
}
