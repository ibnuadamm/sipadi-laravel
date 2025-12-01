<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persediaan;

class PersediaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Persediaan::query();

        // Filter berdasarkan kategori jika ada
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $persediaan = $query->get();

        // Ambil daftar kategori unik untuk dropdown filter
        $kategoriList = Persediaan::select('kategori')->distinct()->pluck('kategori');

        return view('persediaan.index', compact('persediaan', 'kategoriList'));
    }

    public function create()
    {
        return view('persediaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'stok_awal' => 'required|integer',
            'satuan' => 'required|string|max:50',
        ]);

        Persediaan::create($request->all());

        return redirect()->route('persediaan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Persediaan $persediaan)
    {
        return view('persediaan.edit', compact('persediaan'));
    }

    public function update(Request $request, Persediaan $persediaan)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'stok_awal' => 'required|integer',
            'satuan' => 'required|string|max:50',
        ]);

        $persediaan->update($request->all());

        return redirect()->route('persediaan.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(Persediaan $persediaan)
    {
        $persediaan->delete();
        return redirect()->route('persediaan.index')->with('success', 'Data berhasil dihapus.');
    }
}
