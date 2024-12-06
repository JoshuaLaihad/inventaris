@extends('layouts.app')

@section('content')
    <h1>Edit Kesatuan</h1>
    <form method="POST" action="{{ route('kesatuan.update', $kesatuan->id) }}">
        @csrf
        @method('PUT')
        <label>Nama Kesatuan</label>
        <input type="text" name="nama_kesatuan" value="{{ $kesatuan->nama_kesatuan }}" required>
        <button type="submit">Update</button>
    </form>
@endsection
