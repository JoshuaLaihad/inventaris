@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah User Baru</h1>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="kesatuan" class="form-label">Kesatuan</label>
            <input type="text" name="kesatuan" id="kesatuan" placeholder="Inputkan Kesatuan..." class="form-control" value="{{ old('kesatuan') }}" required>
            @error('kesatuan')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="username" name="username" id="username" placeholder="Inputkan Username..." class="form-control" value="{{ old('username') }}" required>
            @error('username')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" placeholder="Inputkan Password..." class="form-control" required>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="Worker" {{ old('role') === 'Worker' ? 'selected' : '' }}>Worker</option>
                <option value="Operator" {{ old('role') === 'Operator' ? 'selected' : '' }}>Operator</option>
                <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Tambah User</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
