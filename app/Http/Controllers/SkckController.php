<?php

namespace App\Http\Controllers;

use App\Models\Skck;
use Illuminate\Http\Request;

class SkckController extends Controller
{
    // Menampilkan semua data SKCK
    public function index()
    {
        $skck = Skck::all(); // Ambil semua data SKCK
        return view('skck.index', compact('skck'));
    }

    // Menampilkan form tambah data SKCK
    public function create()
    {
        $status = Skck::getStatuses(); // Ambil semua status (jika tersedia metode getStatuses di model)
        return view('skck.create', compact('status')); // Tidak ada referensi ke Kesatuan
    }

    // Menyimpan data baru SKCK
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'kesatuan' => 'required|string|max:100', // Langsung menggunakan field kesatuan
            'status' => 'required|in:input,output,rusak', // Validasi status
            'tanggal' => 'required|date',
            'no_box' => 'required|string|max:255',
            'no_reg' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan data ke database
        Skck::create($validated);

        return redirect()->route('skck.index')->with('success', 'Data SKCK berhasil ditambahkan.');
    }

    // Menampilkan form edit data SKCK
    public function edit($id)
    {
        $skck = Skck::findOrFail($id); // Ambil data SKCK berdasarkan ID
        $status = Skck::getStatuses(); // Ambil semua status

        return view('skck.edit', compact('skck', 'status')); // Tidak ada referensi ke Kesatuan
    }

    // Memperbarui data SKCK
    public function update(Request $request, $id)
    {
        // Validasi data input
        $validated = $request->validate([
            'kesatuan' => 'required|string|max:100', // Langsung menggunakan field kesatuan
            'status' => 'required|in:input,output,rusak', // Validasi status
            'tanggal' => 'required|date',
            'no_box' => 'required|string|max:255',
            'no_reg' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $skck = Skck::findOrFail($id); // Cari data SKCK berdasarkan ID
        $skck->update($validated); // Perbarui data di database

        return redirect()->route('skck.index')->with('success', 'Data SKCK berhasil diperbarui.');
    }

    // Menghapus data SKCK
    public function destroy($id)
    {
        $skck = Skck::findOrFail($id); // Cari data SKCK berdasarkan ID
        $skck->delete(); // Hapus data dari database

        return redirect()->route('skck.index')->with('success', 'Data SKCK berhasil dihapus.');
    }
}
