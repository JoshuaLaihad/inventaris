@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Data SKCK</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Tabel</li>
                <li class="breadcrumb-item active">Data SKCK</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('skck.create') }}" class="btn btn-primary mb-3">Tambah SKCK</a></h5>
                        <!-- Table with stripped rows -->

                        <table class="table table-hover table-bordered">
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($skck as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kesatuan }}</td>
                                        <td>{{ ucfirst($item->status) }}</td>
                                        <td>{{ $item->tanggal->format('Y-m-d') }}</td>
                                        <td>{{ $item->no_box }}</td>
                                        <td>{{ $item->no_reg }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>
                                            <a href="{{ route('skck.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('skck.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
