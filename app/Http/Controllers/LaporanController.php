<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // Mengambil data stok bahan per kategori
        $stokBahan = DB::table('bahan_baku')
            ->select('kategori', DB::raw('SUM(jumlah) as total_stok'), DB::raw('SUM(jumlah * harga) as total_nilai'))
            ->groupBy('kategori')
            ->get();

        // Mengambil data pesanan per kategori
        $stokProduk = DB::table('orders')
            ->select('kategori', DB::raw('SUM(jumlah) as total_pesanan'), DB::raw('SUM(total_harga) as total_pendapatan'))
            ->groupBy('kategori')
            ->get();

        // Menghitung total pengeluaran dari input bahan
        $totalPengeluaran = DB::table('bahan_baku')
            ->sum(DB::raw('jumlah * harga'));

        return view('laporan', compact('stokBahan', 'stokProduk', 'totalPengeluaran'));
    }
}