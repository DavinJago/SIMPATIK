<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index() {
        $mahasiswa = Nilai::all();
        return view('daftarnilai', compact('mahasiswa'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'nim'       => 'required|string|unique:nilai',
            'kelas'     => 'required|string',
            'nilai'     => 'required|integer|min:0|max:100',
            'grade'     => 'required|string',
            'kehadiran' => 'required|integer|min:0|max:100',
        ]);

        Nilai::create($request->all());
        return redirect()->route('nilai.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, Nilai $nilai) {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'nim'       => 'required|string|unique:nilai,nim,' . $nilai->id,
            'kelas'     => 'required|string',
            'nilai'     => 'required|integer|min:0|max:100',
            'grade'     => 'required|string',
            'kehadiran' => 'required|integer|min:0|max:100',
        ]);

        $nilai->update($request->all());
        return redirect()->route('nilai.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(Nilai $nilai) {
        $nilai->delete();
        return redirect()->route('nilai.index')->with('success', 'Data berhasil dihapus!');
    }
}