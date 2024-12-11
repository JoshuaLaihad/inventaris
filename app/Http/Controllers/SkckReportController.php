<?php

namespace App\Http\Controllers;

use App\Models\Skck;
use App\Models\Kesatuan;
use Illuminate\Http\Request;

class SkckReportController extends Controller
{
    // Menampilkan data Input
    public function input()
    {
        $skcks = Skck::byStatus('Input')->with(['kesatuan', 'status'])->get();
        return view('skck.input', compact('skcks'));
    }

    // Menampilkan data Output
    public function output()
    {
        $skcks = Skck::byStatus('Output')->with(['kesatuan', 'status'])->get();
        return view('skck.output', compact('skcks'));
    }

    // Menampilkan data Broken
    public function broken()
    {
        $skcks = Skck::byStatus('Rusak')->with(['kesatuan', 'status'])->get();
        return view('skck.broken', compact('skcks'));
    }

    // Menampilkan laporan lengkap
    public function report(Request $request)
    {
        $kesatuan_id = $request->input('kesatuan_id');
        $month = $request->input('month');

        // Query awal
        $query = SKCK::query();

        // Terapkan filter berdasarkan kondisi
        if ($kesatuan_id) {
            $query->where('kesatuan_id', $kesatuan_id);
        }

        if ($month) {
            $query->whereMonth('tanggal', $month);
        }

        $skcks = $query->paginate(10)->appends($request->query()); // Pagination dan tambahkan query params


        // Ambil data untuk tabel dengan pagination
        $skcks = $query->with(['kesatuan', 'status'])->paginate(10); // Menampilkan 10 data per halaman


        // Hitung input, output, dan rusak sesuai dengan filter yang diterapkan
        $filteredQuery = SKCK::query(); // Query baru untuk menghitung jumlah stok

        if ($kesatuan_id) {
            $filteredQuery->where('kesatuan_id', $kesatuan_id);
        }

        if ($month) {
            $filteredQuery->whereMonth('tanggal', $month);
        }

        // Hitung berdasarkan status
        $input = $filteredQuery->clone()->where('status_id', 1)->sum('jumlah'); // Status 1: Input
        $output = $filteredQuery->clone()->where('status_id', 2)->sum('jumlah'); // Status 2: Output
        $rusak = $filteredQuery->clone()->where('status_id', 3)->sum('jumlah'); // Status 3: Rusak

        // Hitung sisa stok
        $sisaStok = $input - ($output + $rusak);

        return view('skck.report', [
            'skcks' => $skcks,
            'kesatuans' => Kesatuan::all(),
            'sisaStok' => $sisaStok,
        ]);
    }
}
