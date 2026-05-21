<?php

namespace App\Http\Controllers;

use App\Models\Banksoal;
use Illuminate\Http\Request;

class BanksoalController extends Controller
{
    public function index() {
        $soals = Banksoal::all();
        return view('banksoal', compact('soals'));
    }

    public function store(Request $request) {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'jumlah_soal' => 'required|integer|min:1',
            'praktikum'   => 'nullable|string',
            'mata_kuliah' => 'nullable|string',
        ]);

        Banksoal::create($request->all());
        return redirect()->route('banksoal.index')->with('success', 'Bank soal berhasil ditambahkan!');
    }

    public function update(Request $request, Banksoal $banksoal) {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'jumlah_soal' => 'required|integer|min:1',
            'praktikum'   => 'nullable|string',
            'mata_kuliah' => 'nullable|string',
        ]);

        $banksoal->update($request->all());
        return redirect()->route('banksoal.index')->with('success', 'Bank soal berhasil diupdate!');
    }

    public function destroy(Banksoal $banksoal) {
        $banksoal->delete();
        return redirect()->route('banksoal.index')->with('success', 'Bank soal berhasil dihapus!');
    }
}