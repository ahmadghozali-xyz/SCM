<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Untuk query database

class BerandaController extends Controller
{
    public function index()
    {
        return view('beranda'); // Mengarahkan ke view beranda
    }

    // Tambahkan metode lain untuk mengelola data sesuai kebutuhan
}
