<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class registercontroller extends Controller
{
    public function register_index()
    {
        $users = User::with(['guru', 'siswa'])->get();
        $gurus = Guru::select('id', 'name', 'email')->get(); // Tambahkan select untuk email
        $siswas = Siswa::select('id', 'name', 'email')->get(); // Tambahkan select untuk email
        return view('register', compact('users', 'gurus', 'siswas'));
    }
    public function register_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'password' => 'required|string|min:8',
            'tipe' => 'required|in:guru,siswa',
            'guru_id' => 'required_if:tipe,guru|exists:gurus,id', // Sesuai permintaan
            'siswa_id' => 'required_if:tipe,siswa|exists:siswas,id', // Sesuai permintaan
        ]);
        $role = $request->tipe;
        // Logika eksplisit: jika guru_id berisi, siswa_id = null
        if ($request->filled('guru_id')) {
            $guru_id = $request->guru_id;
            $siswa_id = null;
        } elseif ($request->filled('siswa_id')) {
            $guru_id = null;
            $siswa_id = $request->siswa_id;
        } else {
            $guru_id = null;
            $siswa_id = null;
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'guru_id' => $guru_id, // Jika guru, ini ada; jika siswa, null
            'siswa_id' => $siswa_id, // Jika siswa, ini ada; jika guru, null
        ]);

        return redirect()->route('register');
    }

    Public function register_update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'tipe' => 'required|in:guru,siswa',
            'guru_id' => 'required_if:tipe,gurus|exists:gurus,id',
            'siswa_id' => 'required_if:tipe,siswas|exists:siswas,id',
        ]);
        $role = $request->tipe;
        $guru_id = $request->tipe === 'guru' ? $request->guru_id : null;
        $siswa_id = $request->tipe === 'siswa' ? $request->siswa_id : null;
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $role,
            'guru_id' => $guru_id,
            'siswa_id' => $siswa_id,
        ];
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }
        $user->update($updateData);
        return redirect()->route('register');
    }
    public function register_destroy(User $user)
    {
        $user->delete();
        return redirect()->route('register');
    }
}
