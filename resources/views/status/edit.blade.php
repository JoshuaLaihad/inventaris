@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Status</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('status.update', $status->id) }}">
                @csrf
                @method('PUT') <!-- Add this line to spoof the PUT method -->
                <div class="mb-3">
                    <label for="nama_status" class="form-label">Nama Status</label>
                    <input type="text" name="nama_status" value="{{ $status->nama_status }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
@endsection
