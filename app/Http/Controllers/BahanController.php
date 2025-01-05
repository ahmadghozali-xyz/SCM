<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BahanController extends Controller
{
    public function showInputForm()
    {
        return view('input_bahan'); // Ganti dengan nama view input bahan Anda
    }

    public function store(Request $request)
    {
        // Validasi inputan jika diperlukan
        $request->validate([
            'nama_bahan' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'jumlah' => 'required|integer',
            'pemasok' => 'nullable|string|max:255',
            'harga' => 'nullable|numeric',
        ]);

        // Simpan data ke database
        DB::table('bahan_baku')->insert([
            'nama_bahan' => $request->nama_bahan,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'pemasok' => $request->pemasok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('informasi')->with('success', 'Data berhasil ditambahkan!');
    }

    // Menampilkan data stok
    public function showStock()
    {
        // Ambil data dari tabel bahan_baku
        $dataStok = DB::table('bahan_baku')->get(); // Pastikan nama tabel sesuai
        
        return view('stok', compact('dataStok')); // Kirim data ke view stok
    }
}
