@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Data SKCK</h1>
    <a href="{{ route('skck.create') }}" class="btn btn-primary mb-3">Tambah SKCK</a>

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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($skck as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kesatuan->nama_kesatuan }}</td>
                    <td>{{ $item->status->nama_status }}</td>
                    <td>{{ $item->tanggal }}</td>
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
@endsection
