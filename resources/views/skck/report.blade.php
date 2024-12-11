@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1">Halaman Laporan Data SKCK</h1>
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
                        <form action="{{ route('skck.report') }}" method="GET" class="mb-4">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label for="kesatuan_id" class="form-label">Kesatuan</label>
                                    <select name="kesatuan_id" id="kesatuan_id" class="form-select">
                                        <option value="">Semua Kesatuan</option>
                                        @foreach ($kesatuans as $kesatuan)
                                            <option value="{{ $kesatuan->id }}"
                                                {{ request('kesatuan_id') == $kesatuan->id ? 'selected' : '' }}>
                                                {{ $kesatuan->nama_kesatuan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="month" class="form-label">Bulan</label>
                                    <select name="month" id="month" class="form-select">
                                        <option value="">Semua Bulan</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::createFromDate(null, $i, 1)->format('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                                </div>
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
                                        <td>{{ $item->kesatuan->nama_kesatuan }}</td>
                                        <td>{{ $item->status->nama_status }}</td>
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
