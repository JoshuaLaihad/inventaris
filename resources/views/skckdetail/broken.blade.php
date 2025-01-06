@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Halaman Data Rusak</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Tabel</li>
                <li class="breadcrumb-item active">Data Rusak</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Operator')
                    <form method="GET" action="{{ route('skckdetail.broken') }}" class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label for="kesatuan_id" class="form-label">Kesatuan</label>
                            <select id="kesatuan_id" name="kesatuan_id" class="form-select">
                                <option value="">-- Semua Kesatuan --</option>
                                @foreach ($kesatuanOptions as $id => $kesatuan)
                                    <option value="{{ $id }}" {{ request('kesatuan_id') == $id ? 'selected' : '' }}>
                                        {{ $kesatuan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 align-self-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Rusak</h5>
                        <!-- Table with stripped rows -->
                        <table class="table table-bordered table-hover datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kesatuan</th>
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
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kesatuan->kesatuan }}</td>
                                        <td>{{ $item->tanggal->format('Y-m-d') }}</td>
                                        <td>{{ $item->no_box }}</td>
                                        <td>{{ $item->no_reg }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                let table = document.querySelector('.datatable');
                                if (table) {
                                    new simpleDatatables.DataTable(table);
                                }
                            });
                        </script>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
