@extends('layouts.app')

@section('content')
    <h1>Data Rusak SKCK</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kesatuan</th>
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
                    <td>{{ $item->kesatuan->nama_kesatuan }}</td>
                    <td>{{ $item->no_box }}</td>
                    <td>{{ $item->no_reg }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
