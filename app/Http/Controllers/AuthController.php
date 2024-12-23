<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan Form Registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses Registrasi
    public function register(Request $request)
    {
        // Debug data yang diterima
        // dd($request->all());

        $validated = $request->validate([
            'kesatuan' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users', // Email hanya string
            'password' => 'required|string|min:8', // Password minimal 8 karakter
        ]);

        // Simpan data ke database
        User::create([
            'kesatuan' => $validated['kesatuan'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']), // Hash password
        ]);

        //dd(Hash::make($validated['password']));

        return redirect()->route('login.form')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Tampilkan Form Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => 'required|string', // Gunakan string untuk validasi username
            'password' => 'required|string', // Password diperlukan
        ]);

        
        // Debug: cek apakah pengguna dengan username ini ada
        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            // Kirim pesan error jika pengguna tidak ditemukan
            return back()->withErrors([
                'username' => 'Username (Email) tidak ditemukan.',
            ])->withInput($request->only('username'));
        }

        // if (!Hash::check($credentials['password'], $user->password)) {
        //     dd('Password entered:', $credentials['password'], 'Password hashed in DB:', $user->password);
        // }
        
        // Debug: cek apakah password cocok
        if (!Hash::check($credentials['password'], $user->password)) {
            // Kirim pesan error jika password salah
            return back()->withErrors([
                'password' => 'Password yang dimasukkan salah.',
            ])->withInput($request->only('username'));
        }

        // Debug: cek Auth::attempt
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home'); // Ganti dengan rute dashboard atau halaman utama
        }

        // Jika login gagal karena alasan lain
        return back()->withErrors([
            'login' => 'Terjadi masalah saat mencoba masuk. Silakan coba lagi.',
        ])->withInput($request->only('username'));
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
