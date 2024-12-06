@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Data Kesatuan</h1>
    <a href="{{ route('kesatuan.create') }}" class="btn btn-primary mb-3">Tambah Kesatuan</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kesatuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kesatuan as $kesatuan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kesatuan->nama_kesatuan }}</td>
                    <td>
                        <a href="{{ route('kesatuan.edit', $kesatuan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kesatuan.destroy', $kesatuan->id) }}" method="POST" class="d-inline">
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
