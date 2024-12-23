<?php

namespace App\Http\Controllers;

use App\Models\Skck;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkckController extends Controller
{
    // Menampilkan semua data SKCK
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Skck::query();

        // Jika role adalah Worker, hanya tampilkan data sesuai kesatuan user
        if ($user->role === 'Worker') {
            $query->where('kesatuan_id', $user->id);
            $kesatuanOptions = []; // Tidak ada opsi filter untuk Worker
        } else {
            // Admin/operator dapat melihat semua data
            $kesatuanOptions = User::pluck('kesatuan', 'id');

            // Terapkan filter jika bukan Worker
            if ($request->has('kesatuan_id') && $request->kesatuan_id) {
                $query->where('kesatuan_id', $request->kesatuan_id);
            }
        }
        
        // Dapatkan data SKCK dengan relasi kesatuan
        $skcks = $query->with('kesatuan')->paginate(10);

        return view('skck.index', compact('skcks', 'kesatuanOptions'));
    }

    // Menampilkan form tambah data SKCK
    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'Worker') {
            // Worker hanya dapat mengisi data untuk kesatuannya sendiri
            $kesatuanOptions = User::where('id', $user->id)->pluck('kesatuan', 'id');
        } else {
            // Admin/operator dapat memilih kesatuan
            $kesatuanOptions = User::pluck('kesatuan', 'id');
        }

        $statusOptions = Skck::getStatuses();
        return view('skck.create', compact('kesatuanOptions', 'statusOptions'));
    }

    // Menyimpan data baru SKCK
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kesatuan_id' => 'required|exists:users,id', // Validasi kesatuan ID
            'status' => 'required|in:input,output,rusak', // Validasi status
            'tanggal' => 'required|date',
            'no_box' => 'required|string|max:255',
            'no_reg' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        Skck::create($validated);

        return redirect()->route('skck.index')->with('success', 'Data SKCK berhasil ditambahkan.');
    }

    // Menampilkan form edit data SKCK
    public function edit($id)
    {
        $user = Auth::user();
        $skck = Skck::findOrFail($id);

        // Cegah Worker mengakses data yang bukan miliknya
        if ($user->role === 'Worker' && $skck->kesatuan_id !== $user->id) {
            abort(403, 'Anda tidak diizinkan mengakses data ini.');
        }

        if ($user->role === 'Worker') {
            $kesatuanOptions = User::where('id', $user->id)->pluck('kesatuan', 'id');
        } else {
            $kesatuanOptions = User::pluck('kesatuan', 'id');
        }

        $statusOptions = Skck::getStatuses();
        return view('skck.edit', compact('skck', 'kesatuanOptions', 'statusOptions'));
    }

    // Memperbarui data SKCK
    public function update(Request $request, $id)
    {
        $skck = Skck::findOrFail($id);

        // Cegah Worker mengedit data yang bukan miliknya
        if (Auth::user()->role === 'Worker' && $skck->kesatuan_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan mengakses data ini.');
        }

        $validated = $request->validate([
            'kesatuan_id' => 'required|exists:users,id', // Validasi kesatuan ID
            'status' => 'required|in:input,output,rusak', // Validasi status
            'tanggal' => 'required|date',
            'no_box' => 'required|string|max:255',
            'no_reg' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $skck->update($validated);

        return redirect()->route('skck.index')->with('success', 'Data SKCK berhasil diperbarui.');
    }

    // Menghapus data SKCK
    public function destroy($id)
    {
        $skck = Skck::findOrFail($id);

        // Cegah Worker menghapus data yang bukan miliknya
        if (Auth::user()->role === 'Worker' && $skck->kesatuan_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan mengakses data ini.');
        }

        $skck->delete();

        return redirect()->route('skck.index')->with('success', 'Data SKCK berhasil dihapus.');
    }
}
