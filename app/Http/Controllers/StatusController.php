<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return view('status.index', compact('statuses'));
    }

    public function create()
    {
        return view('status.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_status' => 'required|string|max:255',
        ]);

        Status::create([
            'nama_status' => $request->nama_status,
        ]);

        return redirect()->route('status.index')->with('success', 'Status berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $status = Status::findOrFail($id); // Ambil berdasarkan ID
        return view('status.edit', compact('status'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_status' => 'required|string|max:255',
        ]);

        $status = Status::findOrFail($id); // Ambil berdasarkan ID
        $status->update($validated);

        return redirect()->route('status.index')->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $status = Status::findOrFail($id); // Ambil berdasarkan ID
        $status->delete();

        return redirect()->route('status.index')->with('success', 'Status berhasil dihapus.');
    }
}

