@extends('layouts.app')

@section('content')
    <h1>Tambah Data SKCK</h1>
    <form method="POST" action="{{ route('skck.store') }}">
        @csrf
        <label>Kesatuan</label>
        <select name="kesatuan_id">
            @foreach ($kesatuan as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kesatuan }}</option>
            @endforeach
        </select>

        <label>Status</label>
        <select name="status_id">
            @foreach ($status as $s)
                <option value="{{ $s->id }}">{{ $s->nama_status }}</option>
            @endforeach
        </select>

        <label>Tanggal</label>
        <input type="date" name="tanggal">

        <label>No Box</label>
        <input type="text" name="no_box">

        <label>No Reg</label>
        <input type="text" name="no_reg">

        <label>Jumlah</label>
        <input type="number" name="jumlah">

        <label>Keterangan</label>
        <textarea name="keterangan"></textarea>

        <button type="submit">Simpan</button>
    </form>
@endsection
