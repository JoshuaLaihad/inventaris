<?php

namespace App\Http\Controllers;

use App\Models\Skck;
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
        $skcks = Skck::byStatus('Broken')->with(['kesatuan', 'status'])->get();
        return view('skck.broken', compact('skcks'));
    }

    // Menampilkan laporan lengkap
    public function report()
    {
        $skcks = Skck::with(['kesatuan', 'status'])->get();

        // Hitung sisa stok
        $sisaStok = Skck::byStatus('Input')->sum('jumlah') - 
                    Skck::byStatus('Output')->sum('jumlah') - 
                    Skck::byStatus('Rusak')->sum('jumlah');

        return view('skck.report', compact('skcks', 'sisaStok'));
    }
}
