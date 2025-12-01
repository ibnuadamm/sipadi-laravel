<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HargaPasar;
use GuzzleHttp\Client;
use Carbon\Carbon;

class PrediksiHargaController extends Controller
{
    public function index()
    {
        return view('prediksi.index');
    }

    public function predict(Request $request)
    {
        $lokasi = $request->lokasi;
        $produk = $request->produk;

        // Ambil data harga dari API eksternal
        $client = new Client();
        $tanggal = Carbon::now()->toDateString();

        try {
            $response = $client->request('GET', 'https://api-harga-pertanian-lokal.com/harga', [
    'query' => ['lokasi' => $lokasi, 'produk' => $produk]
]);


            $data = json_decode($response->getBody(), true);

            if(empty($data)) {
                return back()->with('error', 'Data harga pasar tidak tersedia.');
            }

            // Simpan data harga ke database (optional)
            foreach($data as $item){
                HargaPasar::updateOrCreate(
                    [
                        'lokasi' => $lokasi,
                        'produk' => $produk,
                        'tanggal' => $tanggal
                    ],
                    [
                        'harga' => $item['harga']
                    ]
                );
            }

            // Prediksi sederhana: rata-rata harga terbaru
            $hargaPrediksi = collect($data)->avg('harga');

            return view('prediksi.index', compact('hargaPrediksi', 'lokasi', 'produk'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengambil data harga: '.$e->getMessage());
        }
    }
}
