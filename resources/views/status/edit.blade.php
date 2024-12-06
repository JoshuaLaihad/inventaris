@extends('layouts.app')

@section('content')
    <h1>Edit Status</h1>
    <form method="POST" action="{{ route('status.update', $status->id) }}">
        @csrf
        @method('PUT')
        <label>Nama Status</label>
        <input type="text" name="nama_status" value="{{ $status->nama_status }}" required>
        <button type="submit">Update</button>
    </form>
@endsection
