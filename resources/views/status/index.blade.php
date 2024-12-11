@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1">Data Status</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Tabel</li>
            <li class="breadcrumb-item active">Data Status</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="blur-section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('status.create') }}" class="btn btn-primary mb-3">Tambah Status</a></h5>
                    <!-- Table with stripped rows -->
                    
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($statuses as $status)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $status->nama_status }}</td>
                                    <td>
                                        <a href="{{ route('status.edit', $status->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('status.destroy', $status->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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