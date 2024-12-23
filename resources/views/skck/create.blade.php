@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Halaman Tambah Data SKCK</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Tambah Data</a></li>
                <li class="breadcrumb-item active">SKCK</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Kesatuan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('skck.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    @if (Auth::user()->role === 'Worker')
                        <!-- Jika role adalah Worker -->
                        <label for="kesatuan">Kesatuan:</label>
                        <input type="text" id="kesatuan" name="kesatuan"
                            class="form-control" value="{{ Auth::user()->kesatuan }}" readonly>
                        <input type="hidden" name="kesatuan_id" value="{{ Auth::id() }}">
                    @else
                        <!-- Jika role adalah admin atau operator -->
                        <label for="kesatuan_id">Kesatuan:</label>
                        <select name="kesatuan_id" id="kesatuan_id" class="form-select" required>
                            <option value="">Pilih Kesatuan</option>
                            @foreach ($kesatuanOptions as $id => $kesatuan)
                                <option value="{{ $id }}"
                                    {{ isset($skck) && $skck->kesatuan_id == $id ? 'selected' : '' }}>
                                    {{ $kesatuan }}
                                </option>
                            @endforeach
                        </select>
                        @error('kesatuan_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    @endif
                </div>



                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="" disabled selected>Pilih Status</option>
                        @foreach ($statusOptions as $s)
                            <option value="{{ $s }}" {{ old('status') === $s ? 'selected' : '' }}>
                                {{ ucfirst($s) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal"
                        class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="no_box" class="form-label">No Box</label>
                    <input type="text" id="no_box" name="no_box"
                        class="form-control @error('no_box') is-invalid @enderror" value="{{ old('no_box') }}" required>
                    @error('no_box')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="no_reg" class="form-label">No Reg</label>
                    <input type="text" id="no_reg" name="no_reg"
                        class="form-control @error('no_reg') is-invalid @enderror" value="{{ old('no_reg') }}" required>
                    @error('no_reg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah"
                        class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" required>
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
