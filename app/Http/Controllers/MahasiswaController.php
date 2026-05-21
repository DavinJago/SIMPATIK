<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index() {
        $mahasiswa = Mahasiswa::all();
        return view('jadwal', compact('mahasiswa'));
    }

    public function store(Request $request) {
        $request->validate([
                'nama'        => 'required|string|max:255',
                'nim'         => 'required|string|unique:mahasiswas,nim,' . ($mahasiswa->id ?? 'NULL'),
                'kelas'       => 'required|string',
                'mata_kuliah' => 'nullable|string',
                'hari'        => 'required|string',
                'jam_mulai'   => 'required',
                'jam_selesai' => 'required',
            ]);

        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    public function update(Request $request, Mahasiswa $mahasiswa) {
        $request->validate([
                'nama'        => 'required|string|max:255',
                'nim'         => 'required|string|unique:mahasiswas,nim,' . ($mahasiswa->id ?? 'NULL'),
                'kelas'       => 'required|string',
                'mata_kuliah' => 'nullable|string',
                'hari'        => 'required|string',
                'jam_mulai'   => 'required',
                'jam_selesai' => 'required',
            ]);

        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diupdate!');
    }

    public function destroy(Mahasiswa $mahasiswa) {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus!');
    }
}