<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beban;

class BebanController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->month;
        $year  = $request->year;

        $query = Beban::query();

        // Filter bulan
        if ($month) {
            $query->whereMonth('tanggal', $month);
        }

        // Filter tahun
        if ($year) {
            $query->whereYear('tanggal', $year);
        }

        // Data beban hasil filter
        $beban = $query->orderBy('tanggal', 'desc')->get();

        // Total beban hasil filter
        $total = $query->sum('nominal');

        return view('beban.index', compact('beban', 'month', 'year', 'total'));
    }

    public function create()
    {
        return view('beban.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_beban' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        Beban::create($request->all());

        return redirect()->route('beban.index')
            ->with('success', 'Data beban berhasil ditambahkan.');
    }

    public function edit(Beban $beban)
    {
        return view('beban.edit', compact('beban'));
    }

    public function update(Request $request, Beban $beban)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_beban' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
        ]);

        $beban->update($request->all());

        return redirect()->route('beban.index')
            ->with('success', 'Data beban berhasil diperbarui.');
    }

    public function destroy(Beban $beban)
    {
        $beban->delete();

        return redirect()->route('beban.index')
            ->with('success', 'Data beban berhasil dihapus.');
    }
}
