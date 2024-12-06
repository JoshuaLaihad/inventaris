@extends('layouts.app')

@section('content')
    <h1>Tambah Status</h1>
    <form method="POST" action="{{ route('status.store') }}">
        @csrf
        <label>Nama Status</label>
        <input type="text" name="nama_status" required>
        <button type="submit">Simpan</button>
    </form>
@endsection
