@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Kesatuan</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('kesatuan.update', $kesatuan->id) }}">
                @csrf
                @method('PUT') <!-- Add this line to spoof the PUT method -->
                <div class="mb-3">
                    <label for="nama_kesatuan" class="form-label">Nama Kesatuan</label>
                    <input type="text" name="nama_kesatuan" value="{{ $kesatuan->nama_kesatuan }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
@endsection
