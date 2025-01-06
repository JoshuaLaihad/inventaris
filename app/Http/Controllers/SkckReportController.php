<?php

namespace App\Http\Controllers;

use App\Models\Skck;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\SkckExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SkckReportController extends Controller
{
    // Menampilkan data Input
    public function input(Request $request)
    {
        $user = Auth::user();
        $query = Skck::where('status', 'Input');

        if ($user->role === 'Worker') {
            // Worker hanya melihat data kesatuannya
            $query->where('kesatuan_id', $user->id);
            $kesatuanOptions = [];
        } else {
            // Admin/operator memiliki filter kesatuan
            $kesatuanOptions = User::pluck('kesatuan', 'id');

            if ($request->has('kesatuan_id') && $request->kesatuan_id) {
                $query->where('kesatuan_id', $request->kesatuan_id);
            }
        }

        $skcks = $query->with('kesatuan')->paginate(10);

        return view('skckdetail.input', compact('skcks', 'kesatuanOptions'));
    }

    // Menampilkan data Output
    public function output(Request $request)
    {
        $user = Auth::user();
        $query = Skck::where('status', 'Output');

        if ($user->role === 'Worker') {
            // Worker hanya melihat data kesatuannya
            $query->where('kesatuan_id', $user->id);
            $kesatuanOptions = [];
        } else {
            // Admin/operator memiliki filter kesatuan
            $kesatuanOptions = User::pluck('kesatuan', 'id');

            if ($request->has('kesatuan_id') && $request->kesatuan_id) {
                $query->where('kesatuan_id', $request->kesatuan_id);
            }
        }

        $skcks = $query->with('kesatuan')->paginate(10);

        return view('skckdetail.output', compact('skcks', 'kesatuanOptions'));
    }

    // Menampilkan data Broken
    public function broken(Request $request)
    {
        $user = Auth::user();
        $query = Skck::where('status', 'Rusak');

        if ($user->role === 'Worker') {
            // Worker hanya melihat data kesatuannya
            $query->where('kesatuan_id', $user->id);
            $kesatuanOptions = [];
        } else {
            // Admin/operator memiliki filter kesatuan
            $kesatuanOptions = User::pluck('kesatuan', 'id');

            if ($request->has('kesatuan_id') && $request->kesatuan_id) {
                $query->where('kesatuan_id', $request->kesatuan_id);
            }
        }

        $skcks = $query->with('kesatuan')->paginate(10);

        return view('skckdetail.broken', compact('skcks', 'kesatuanOptions'));
    }

    // Menampilkan laporan lengkap berdasarkan bulan
    // Menampilkan laporan lengkap berdasarkan filter
    public function report(Request $request)
    {
        $user = Auth::user();
        $kesatuanOptions = $user->role === 'Worker' ? [] : User::pluck('kesatuan', 'id');

        $month = $request->input('month');
        $year = $request->input('year');
        $kesatuanId = $request->input('kesatuan_id');

        $query = Skck::query();

        if ($user->role === 'Worker') {
            $query->where('kesatuan_id', $user->id);
        } else {
            if ($kesatuanId) {
                $query->where('kesatuan_id', $kesatuanId);
            }
        }

        if ($month) {
            $query->whereMonth('tanggal', $month);
        }

        if ($year) {
            $query->whereYear('tanggal', $year);
        }

        $skcks = $query->with('kesatuan')->paginate(10)->appends($request->query());

        $input = $query->clone()->where('status', 'Input')->sum('jumlah');
        $output = $query->clone()->where('status', 'Output')->sum('jumlah');
        $rusak = $query->clone()->where('status', 'Rusak')->sum('jumlah');
        $sisaStok = $input - ($output + $rusak);

        return view('skckdetail.report', compact('skcks', 'sisaStok', 'kesatuanOptions', 'month', 'year', 'kesatuanId'));
    }

    public function exportToExcel(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $kesatuanId = $request->input('kesatuan_id');
        $user = Auth::user();

        $query = Skck::query();

        // Filter berdasarkan role user
        if ($user->role === 'Worker') {
            $query->where('kesatuan_id', $user->id);
        } else {
            if ($kesatuanId) {
                $query->where('kesatuan_id', $kesatuanId);
            }
        }

        // Filter bulan dan tahun
        if ($month) {
            $query->whereMonth('tanggal', $month);
        }
        if ($year) {
            $query->whereYear('tanggal', $year);
        }

        // Hitung sisa stok
        $input = $query->clone()->where('status', 'Input')->sum('jumlah');
        $output = $query->clone()->where('status', 'Output')->sum('jumlah');
        $rusak = $query->clone()->where('status', 'Rusak')->sum('jumlah');
        $sisaStok = $input - ($output + $rusak);

        // Nama file
        $fileName = 'SKCK_Stock_Report_' . now()->format('Y_m_d_H_i_s') . '.xlsx';

        // Kirim sisa stok ke class export
        $export = new SkckExport($query, $sisaStok);

        return Excel::download($export, $fileName);
    }
}
