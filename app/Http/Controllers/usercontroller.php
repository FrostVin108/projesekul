<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class usercontroller extends Controller
{
    // Tampilkan form register
    public function showRegisterForm()
    {
        $gurus = Guru::all(); // Untuk dropdown guru
        $siswas = Siswa::all(); // Untuk dropdown siswa
        return view('register', compact('gurus', 'siswas'));
    }

    // Proses register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:guru,siswa', // Tambah required
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Buat user
        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        return view('login');
    }

    // Proses login (tetap pakai email, sesuai kode Anda; jika ingin ganti ke name, ubah seperti sebelumnya)
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            $user = Auth::user();
            if ($user->role === 'guru') {
                return redirect()->route('guru'); // Atau route dashboard guru
            } elseif ($user->role === 'siswa') {
                return redirect()->route('siswa'); // Atau route dashboard siswa
            } else {
                return redirect('/'); // Default
            }
        }

        return back()->withErrors(['name' => 'name atau password salah.']);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}