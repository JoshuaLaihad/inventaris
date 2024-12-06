@extends('layouts.app')

@section('content')
    <h1>Laporan SKCK</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kesatuan</th>
                <th>Status</th>
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
                    <td>{{ $item->status->nama_status }}</td>
                    <td>{{ $item->no_box }}</td>
                    <td>{{ $item->no_reg }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
            <tr class="table-primary">
                <td colspan="5"><strong>Sisa Stok</strong></td>
                <td colspan="2"><strong>{{ $sisaStok }}</strong></td>
            </tr>
        </tbody>
    </table>
@endsection
