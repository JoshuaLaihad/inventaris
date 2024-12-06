@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Data Status</h1>
    <a href="{{ route('status.create') }}" class="btn btn-primary mb-3">Tambah Status</a>

    <table class="table table-bordered">
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
                        <a href="{{ route('status.edit', $status->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('status.destroy', $status->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
