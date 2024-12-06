<?php

namespace App\Http\Controllers;

use App\Models\Kesatuan;
use Illuminate\Http\Request;

class KesatuanController extends Controller
{
    public function index()
    {
        $kesatuan = Kesatuan::all();
        return view('kesatuan.index', compact('kesatuan'));
    }

    public function create()
    {
        return view('kesatuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kesatuan' => 'required|string|max:255',
        ]);

        Kesatuan::create([
            'nama_kesatuan' => $request->nama_kesatuan,
        ]);

        return redirect()->route('kesatuan.index')->with('success', 'Kesatuan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kesatuan = Kesatuan::findOrFail($id); // Ambil berdasarkan ID
        return view('kesatuan.edit', compact('kesatuan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kesatuan' => 'required|string|max:255',
        ]);

        $kesatuan = Kesatuan::findOrFail($id); // Ambil berdasarkan ID
        $kesatuan->update($validated);

        return redirect()->route('kesatuan.index')->with('success', 'Kesatuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kesatuan = Kesatuan::findOrFail($id); // Ambil berdasarkan ID
        $kesatuan->delete();

        return redirect()->route('kesatuan.index')->with('success', 'Kesatuan berhasil dihapus.');
    }
}
