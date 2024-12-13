<?php

namespace App\Http\Controllers;

use App\Models\Skck;
use Illuminate\Http\Request;

class SkckReportController extends Controller
{
    // Menampilkan data Input
    public function input()
    {
        $skcks = Skck::where('status', 'Input')->with('kesatuan')->get();
        return view('skck.input', compact('skcks'));
    }

    // Menampilkan data Output
    public function output()
    {
        $skcks = Skck::where('status', 'Output')->with('kesatuan')->get();
        return view('skck.output', compact('skcks'));
    }

    // Menampilkan data Broken
    public function broken()
    {
        $skcks = Skck::where('status', 'Rusak')->with('kesatuan')->get();
        return view('skck.broken', compact('skcks'));
    }

    // Menampilkan laporan lengkap berdasarkan bulan
    public function report(Request $request)
    {
        $month = $request->input('month'); // Bulan yang dipilih
        $year = $request->input('year');   // Tahun yang dipilih

        // Query awal
        $query = Skck::query();

        // Terapkan filter berdasarkan bulan dan tahun
        if ($month) {
            $query->whereMonth('tanggal', $month);
        }

        if ($year) {
            $query->whereYear('tanggal', $year);
        }

        // Ambil data untuk tabel dengan pagination
        $skcks = $query->with('kesatuan')->paginate(10)->appends($request->query());

        // Hitung jumlah berdasarkan status
        $input = $query->clone()->where('status', 'Input')->sum('jumlah');
        $output = $query->clone()->where('status', 'Output')->sum('jumlah');
        $rusak = $query->clone()->where('status', 'Rusak')->sum('jumlah');

        // Hitung sisa stok
        $sisaStok = $input - ($output + $rusak);

        return view('skck.report', [
            'skcks' => $skcks,
            'sisaStok' => $sisaStok,
            'selectedMonth' => $month,
            'selectedYear' => $year,
        ]);
    }
}
