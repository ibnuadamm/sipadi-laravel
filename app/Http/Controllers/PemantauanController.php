<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemantauan;
use App\Models\Persediaan;

class PemantauanController extends Controller
{
    public function index()
    {
        $pemantauan = Pemantauan::with('persediaan')->get();
        return view('pemantauan.index', compact('pemantauan'));
    }

    public function create()
    {
        // hanya kategori bibit
        $persediaan = Persediaan::where('kategori', 'bibit')->get();
        return view('pemantauan.create', compact('persediaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persediaan_id' => 'required|exists:persediaan,id',
            'lahan' => 'nullable|string|max:255',
            'tanggal_tanam' => 'required|date',
            'jumlah_tanam' => 'required|integer|min:1',
        ]);

        $persediaan = Persediaan::findOrFail($request->persediaan_id);

        // cek apakah stok berjalan mencukupi
        if ($persediaan->stok_berjalan < $request->jumlah_tanam) {
            return back()->withErrors(['jumlah_tanam' => 'Stok berjalan tidak mencukupi']);
        }

        // simpan pemantauan
        Pemantauan::create([
            'persediaan_id' => $request->persediaan_id,
            'lahan' => $request->lahan,
            'tanggal_tanam' => $request->tanggal_tanam,
            'jumlah_tanam' => $request->jumlah_tanam,
        ]);

        return redirect()->route('pemantauan.index')
            ->with('success', 'Data pemantauan berhasil ditambahkan.');
    }

    public function edit(Pemantauan $pemantauan)
    {
        $persediaan = Persediaan::where('kategori', 'bibit')->get();
        return view('pemantauan.edit', compact('pemantauan', 'persediaan'));
    }

    public function update(Request $request, Pemantauan $pemantauan)
    {
        $request->validate([
            'persediaan_id' => 'required|exists:persediaan,id',
            'lahan' => 'nullable|string|max:255',
            'tanggal_tanam' => 'required|date',
            'jumlah_tanam' => 'required|integer|min:1',
            'tanggal_panen' => 'nullable|date',
            'jumlah_panen' => 'nullable|integer|min:0',
        ]);

        $pemantauan->update([
            'persediaan_id' => $request->persediaan_id,
            'lahan' => $request->lahan,
            'tanggal_tanam' => $request->tanggal_tanam,
            'jumlah_tanam' => $request->jumlah_tanam,
            'tanggal_panen' => $request->tanggal_panen,
            'jumlah_panen' => $request->jumlah_panen,
        ]);

        return redirect()->route('pemantauan.index')
            ->with('success', 'Data pemantauan berhasil diperbarui.');
    }

    public function destroy(Pemantauan $pemantauan)
    {
        $pemantauan->delete();

        return redirect()->route('pemantauan.index')
            ->with('success', 'Data pemantauan berhasil dihapus.');
    }
}
