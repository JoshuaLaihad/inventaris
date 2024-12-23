@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New User</h1>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="kesatuan" class="form-label">Kesatuan</label>
            <input type="text" name="kesatuan" id="kesatuan" class="form-control" value="{{ old('kesatuan') }}" required>
            @error('kesatuan')
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
                <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Operator" {{ old('role') === 'Operator' ? 'selected' : '' }}>Operator</option>
                <option value="Worker" {{ old('role') === 'Worker' ? 'selected' : '' }}>Worker</option>
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
