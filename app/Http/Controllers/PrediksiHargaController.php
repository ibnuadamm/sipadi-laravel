<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

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

        $client = new Client();
        $apiKey = env('GEMINI_API_KEY');

        $prompt = "
            Kamu adalah analis harga pertanian di Indonesia.

            Cari estimasi harga pasar terbaru untuk:
            - Produk: $produk
            - Lokasi: $lokasi

            Tampilkan hasil dalam format:

            ==========================================
            INFORMASI PASAR & PREDIKSI
            Produk : $produk
            Lokasi : $lokasi
            ==========================================

            1. Harga pasar rata-rata saat ini (Rp)
            2. Rentang harga umum (Rp)
            3. Rekomendasi harga jual terbaik (Rp)
            4. Analisis singkat (3 poin)

            Tulisan nya jangan ada yang di bold.
        ";

        try {
            $url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=$apiKey";

            $response = $client->post($url, [
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ]
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            $hasil = $result['candidates'][0]['content']['parts'][0]['text']
                ?? 'Tidak ada hasil prediksi dari AI.';

            return view('prediksi.index', compact('hasil', 'lokasi', 'produk'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengambil prediksi: ' . $e->getMessage());
        }
    }
}
