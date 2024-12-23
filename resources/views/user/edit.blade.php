@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit User</h1>

    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kesatuan" class="form-label">Kesatuan</label>
            <input type="text" name="kesatuan" id="kesatuan" class="form-control" value="{{ old('kesatuan', $user->kesatuan) }}" required>
            @error('kesatuan')
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
                <option value="Admin" {{ old('role', $user->role) === 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Operator" {{ old('role', $user->role) === 'Operator' ? 'selected' : '' }}>Operator</option>
                <option value="Worker" {{ old('role', $user->role) === 'Worker' ? 'selected' : '' }}>Worker</option>
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
