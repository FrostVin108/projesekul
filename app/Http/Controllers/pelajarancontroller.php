<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class PelajaranController extends Controller
{
    // CRUD untuk Pelajaran
    public function pelajaran_index()
    {
        $pelajarans = Pelajaran::all();
        return view('pelajaran', compact('pelajarans'));
    }

    public function pelajaran_store(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:255']);
        Pelajaran::create($request->only('nama'));
        return redirect()->route('pelajaran');
    }

    public function pelajaran_update(Request $request, Pelajaran $pelajaran)
    {
        $request->validate(['nama' => 'required|string|max:255']);
        $pelajaran->update($request->only('nama'));
        return redirect()->route('pelajaran');
    }

    public function pelajaran_destroy(Pelajaran $pelajaran)
    {
        $pelajaran->delete();
        return redirect()->route('pelajaran');
    }

    

    // CRUD untuk Jadwal (mirip dengan contoh lainnya)
    public function jadwal_index()
    {
        $jadwals = Jadwal::with('pelajaran')->get(); // Load relasi
        $pelajarans = Pelajaran::all(); // Untuk dropdown
        return view('jadwal', compact('jadwals', 'pelajarans'));
    }

    public function jadwal_store(Request $request)
    {
        $request->validate([
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat',
            'pelajaran_id' => 'required|exists:pelajarans,id',
            'waktu' => 'nullable|date_format:H:i',
        ]);
        Jadwal::create($request->only(['hari', 'pelajaran_id', 'waktu']));
        return redirect()->route('jadwal'); // Asumsi route untuk jadwal, sesuaikan jika perlu
    }

    public function jadwal_update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat',
            'pelajaran_id' => 'required|exists:pelajarans,id',
            'waktu' => 'nullable|date_format:H:i',
        ]);
        $jadwal->update($request->only(['hari', 'pelajaran_id', 'waktu']));
        return redirect()->route('jadwal'); // Asumsi route untuk jadwal
    }

    public function jadwal_destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal'); // Asumsi route untuk jadwal
    }
}