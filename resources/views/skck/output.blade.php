@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Data Output</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Tabel</li>
                <li class="breadcrumb-item active">Data Output</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Output</h5>
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
                                        <td>{{ $item->kesatuan }}</td>
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
