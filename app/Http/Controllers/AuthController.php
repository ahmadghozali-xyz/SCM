<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller {
    // Menampilkan form login
    public function showLoginForm() {
        return view('welcome'); // Ganti dengan nama view login Anda
    }

    // Metode untuk menangani login
    public function login(Request $request) {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cek apakah pengguna adalah admin
        $admin = DB::table('admin')->where('username', $request->username)
                                   ->where('password', $request->password) // Cek password dalam bentuk teks biasa
                                   ->first();

        if ($admin) {
            // Jika admin ditemukan
            session(['username' => $admin->username, 'role' => 'admin']); // Simpan username dan role di session
            return redirect()->route('admin_dashboard'); // Arahkan ke dashboard admin
        }

        // Cek apakah pengguna biasa ada di database
        $user = DB::table('information')->where('username', $request->username)
                                         ->where('password', $request->password) // Cek password dalam bentuk teks biasa
                                         ->first();

        if ($user) {
            // Jika pengguna ditemukan
            session(['username' => $user->username, 'role' => 'user']); // Simpan username dan role di session
            return redirect()->route('beranda'); // Arahkan ke beranda untuk pengguna biasa
        } else {
            // Jika tidak ada pengguna atau password salah
            return back()->withErrors(['username' => 'Username atau password salah!']);
        }
    }

    // Menampilkan informasi data pengguna
    public function informasi() {
        $dataInformasi = DB::table('information')->get(); 
        return view('informasi', compact('dataInformasi')); 
    }

    // Menyimpan pengguna baru ke database
    public function storeUser(Request $request) {
        // Validasi inputan
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:information',
            'email' => 'required|string|email|max:255|unique:information',
            'password' => 'required|string|min:6', 
        ]);

        // Simpan data ke database dengan hashing password untuk keamanan
        DB::table('information')->insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash password sebelum disimpan
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Metode untuk menangani registrasi pengguna baru
    public function register(Request $request) {
        // Validasi inputan jika diperlukan
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:information',
            'email' => 'required|string|email|max:255|unique:information',
            'password' => 'required|string|min:6',
        ]);

        // Simpan data ke database dengan hashing password untuk keamanan
        DB::table('information')->insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash password sebelum disimpan
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
