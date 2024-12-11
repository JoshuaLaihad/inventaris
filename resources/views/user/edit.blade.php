@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit User</h1>

    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">username</label>
            <input type="username" name="username" id="username" class="form-control" value="{{ old('username', $user->username) }}" required>
            @error('username')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (Optional)</label>
            <input type="password" name="password" id="password" class="form-control">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>        

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="ba_intelkam" {{ old('role', $user->role) === 'ba_intelkam' ? 'selected' : '' }}>Ba Intelkam</option>
                <option value="dit_intelkam" {{ old('role', $user->role) === 'dit_intelkam' ? 'selected' : '' }}>Dit Intelkam</option>
                <option value="sat_intelkam" {{ old('role', $user->role) === 'sat_intelkam' ? 'selected' : '' }}>Sat Intelkam</option>
            </select>
            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
