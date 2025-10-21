<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class usercontroller extends Controller
{
    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('register');
    }
    // Proses register
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:guru,siswa',
        ]);
        // Buat user baru
        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        // Redirect ke login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);
        // Coba login
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->role === 'guru') {
                return redirect()->intended('/guru'); // Sesuaikan route dashboard guru
            } elseif ($user->role === 'siswa') {
                return redirect()->intended('/siswa'); // Sesuaikan route dashboard siswa
            }
        }
        // Jika gagal, throw error
        throw ValidationException::withMessages([
            'name' => ['Nama atau password salah.'],
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}