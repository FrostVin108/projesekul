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
        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('dashboard');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $failCount = session()->get('login_fail_count', 0);

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            session()->forget('login_fail_count');
            $user = Auth::user();

            // Redirect role berdasarkan
            if ($user->role === 'guru') {
                return redirect()->intended('/guru');
            } elseif ($user->role === 'siswa') {
                return redirect()->intended('/siswa');
            }
        } else {
            $failCount++;
            session()->put('login_fail_count', $failCount);

            if ($failCount == 5) {
                return back()->withErrors(['warning' => 'Login gagal 5 kali - harap periksa kembali data Anda.']);
            } elseif ($failCount == 10) {
                // Kirim flag ke frontend agar buka tab baru
                return back()->withErrors([
                    'open_tab' => true,
                    'message' => 'Login gagal 10 kali, dasar pelupa identitas!'
                ]);
            } elseif ($failCount >= 20) {
                return redirect()->route('shutdown');
                
                // Kirim flag shutdown (logika shutdown murni ada di client side dengan JS / aplikasi)
                // return back()->withErrors([
                //     'shutdown' => true,
                //     'message' => 'Login gagal 20 kali - sistem akan dimatikan.'
                // ]);
            }

            return back()->withErrors([
                'name' => ['Nama atau password salah.'],
            ]);
        }
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