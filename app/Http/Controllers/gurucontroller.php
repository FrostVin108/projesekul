<?php

namespace App\Http\Controllers;

use App\Models\bidang_guru;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    // CRUD untuk BidangGuru
    public function index()
    {
        $bidanggurus = bidang_guru::all();
        return view('guru.bidang', compact('bidanggurus'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        bidang_guru::create($request->only('name'));
        return redirect()->route('guru.bidang');
    }

    public function update(Request $request, bidang_guru $bidangGuru)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $bidangGuru->update($request->only('name'));
        return redirect()->route('guru.bidang');
    }

    public function destroy(bidang_guru $bidangGuru)
    {
        $bidangGuru->delete();
        return redirect()->route('guru.bidang');
    }

    // CRUD untuk Guru
    public function guru_index()
    {
        $gurus = Guru::with('bidangGuru')->get(); // Load relasi
        $bidangGurus = bidang_guru::all(); // Untuk dropdown
        return view('guru.guru', compact('gurus', 'bidangGurus'));
    }

    public function guru_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:gurus,email',
            'tanggal_lahir' => 'required|date',
            'guru_bidang_id' => 'required|exists:bidang_gurus,id', // Perbaiki: gunakan nama FK yang benar
            'bio' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);
        Guru::create($request->only(['name', 'email', 'tanggal_lahir', 'guru_bidang_id', 'bio', 'status']));
        return redirect()->route('guru');
    }

    public function guru_update(Request $request, Guru $guru)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:gurus,email,' . $guru->id,
            'tanggal_lahir' => 'required|date',
            'guru_bidang_id' => 'required|exists:bidang_gurus,id', // Perbaiki: gunakan nama FK yang benar
            'bio' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);
        $guru->update($request->only(['name', 'email', 'tanggal_lahir', 'guru_bidang_id', 'bio', 'status']));
        return redirect()->route('guru');
    }

    public function guru_destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('guru');
    }
}