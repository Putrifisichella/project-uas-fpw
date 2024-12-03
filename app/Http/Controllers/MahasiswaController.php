<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'npm' => 'required|unique:mahasiswa',
            'nama' => 'required',
            'prodi' => 'required',
        ]);

        Mahasiswa::create($validated);

        return redirect()->back()->with('success', 'Data mahasiswa berhasil disimpan');
    }

    public function destroy($id)
    {
        Mahasiswa::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus');
    }


}
