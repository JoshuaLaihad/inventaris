@extends('layouts.app')

@section('content')
    <h1>Tambah Kesatuan</h1>
    <form method="POST" action="{{ route('kesatuan.store') }}">
        @csrf
        <label>Nama Kesatuan</label>
        <input type="text" name="nama_kesatuan" required>
        <button type="submit">Simpan</button>
    </form>
@endsection
