@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New User</h1>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">username</label>
            <input type="username" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
            @error('username')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="ba_intelkam" {{ old('role') === 'ba_intelkam' ? 'selected' : '' }}>Ba Intelkam</option>
                <option value="dit_intelkam" {{ old('role') === 'dit_intelkam' ? 'selected' : '' }}>Dit Intelkam</option>
                <option value="sat_intelkam" {{ old('role') === 'sat_intelkam' ? 'selected' : '' }}>Sat Intelkam</option>
            </select>
            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add User</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
