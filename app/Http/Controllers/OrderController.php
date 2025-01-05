<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showOrderForm()
    {
        return view('order_bahan');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kategori' => 'required|string',
            'ukuran' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric'
        ]);

        // Hitung total harga
        $total_harga = $request->jumlah * $request->harga;

        // Simpan pesanan ke database
        DB::table('orders')->insert([
            'kategori' => $request->kategori,
            'ukuran' => $request->ukuran,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $request->harga,
            'total_harga' => $total_harga,
            'status' => 'pending',
            'tanggal_order' => now(),
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
    }
}