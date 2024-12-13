@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Halaman Laporan Data SKCK</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Tabel</li>
                    <li class="breadcrumb-item active">Laporan SKCK</li>
                </ol>
            </nav>
    </div><!-- End Page Title -->

    <section class="blur-section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('skck.report') }}" class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label for="month" class="form-label">Bulan</label>
                                <select id="month" name="month" class="form-select">
                                    <option value="">-- Pilih Bulan --</option>
                                    @foreach (range(1, 12) as $m)
                                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="year" class="form-label">Tahun</label>
                                <select id="year" name="year" class="form-select">
                                    <option value="">-- Pilih Tahun --</option>
                                    @foreach (range(date('Y') - 10, date('Y')) as $y) {{-- 10 tahun terakhir --}}
                                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 align-self-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                        
                        <!-- Table with stripped rows -->

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kesatuan</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>No Box</th>
                                    <th>No Reg</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($skcks as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + ($skcks->currentPage() - 1) * $skcks->perPage() }}</td>
                                        <td>{{ $item->kesatuan }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->tanggal->format('Y-m-d') }}</td>
                                        <td>{{ $item->no_box }}</td>
                                        <td>{{ $item->no_reg }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                    </tr>
                                @endforeach
                                <tr class="table-primary">
                                    <td colspan="6"><strong>Sisa Stok</strong></td>
                                    <td colspan="2"><strong>{{ $sisaStok }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="{{ route('skck.export') }}" method="GET" class="d-inline">
                            <input type="hidden" name="month" value="{{ request('month') }}">
                            <input type="hidden" name="year" value="{{ request('year') }}">
                            <button type="submit" class="btn btn-success">Export to Excel</button>
                        </form>
                        <!-- End Table with stripped rows -->
                        <div class="d-flex justify-content-center">
                            {{ $skcks->links() }}
                        </div>
                    </div>
                    
                </div>
                
                
            </div>
        </div>
    </section>
@endsection
