<?php

namespace App\Http\Controllers;

use App\Models\Skck;
use App\Models\Kesatuan;
use App\Models\Status;
use Illuminate\Http\Request;

class SkckController extends Controller
{
    public function index()
    {
        $skck = Skck::with(['kesatuan', 'status'])->get();
        return view('skck.index', compact('skck'));
    }

    public function create()
    {
        $kesatuan = Kesatuan::all();
        $status = Status::all();
        return view('skck.create', compact('kesatuan', 'status'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kesatuan_id' => 'required|exists:kesatuans,id',
            'status_id' => 'required|exists:statuses,id',
            'tanggal' => 'required|date',
            'no_box' => 'required|string|max:255',
            'no_reg' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        Skck::create($validated);
        return redirect()->route('skck.index')->with('success', 'Data SKCK berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $skck = Skck::findOrFail($id); // Ambil SKCK berdasarkan ID
        $kesatuan = Kesatuan::all(); // Ambil semua data Kesatuan untuk dropdown
        $status = Status::all(); // Ambil semua data Status untuk dropdown
    
        // Kirim data ke view
        return view('skck.edit', compact('skck', 'kesatuan', 'status'));
    }
    

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kesatuan_id' => 'required|exists:kesatuans,id',
            'status_id' => 'required|exists:statuses,id',
            'tanggal' => 'required|date',
            'no_box' => 'required|string|max:255',
            'no_reg' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);


        $skck = Skck::findOrFail($id); // Cari SKCK berdasarkan ID
        $skck->update($validated);

        return redirect()->route('skck.index')->with('success', 'Data SKCK berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $skck = Skck::findOrFail($id); // Cari SKCK berdasarkan ID
        $skck->delete();

        return redirect()->route('skck.index')->with('success', 'Data SKCK berhasil dihapus.');
    }
}
