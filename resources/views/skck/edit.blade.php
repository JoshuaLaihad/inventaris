@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Edit SKCK</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('skck.update', $skck->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Kesatuan -->
                <div class="mb-3">
                    <label for="kesatuan_id" class="form-label">Kesatuan</label>
                    <select name="kesatuan_id" id="kesatuan_id" class="form-select">
                        <option value="" disabled>Pilih Kesatuan</option>
                        @foreach ($kesatuanOptions as $id => $kesatuan)
                            <option value="{{ $id }}" {{ $skck->kesatuan_id == $id ? 'selected' : '' }}>
                                {{ $kesatuan }}
                            </option>
                        @endforeach
                    </select>
                    @error('kesatuan_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="" disabled>Pilih Status</option>
                        @foreach ($statusOptions as $status)
                            <option value="{{ $status }}"
                            {{ $skck->status === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>



                <!-- Tanggal -->
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal"
                        class="form-control @error('tanggal') is-invalid @enderror"
                        value="{{ old('tanggal', $skck->tanggal ? \Carbon\Carbon::parse($skck->tanggal)->format('Y-m-d') : '') }}"
                        required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- No Box -->
                <div class="mb-3">
                    <label for="no_box" class="form-label">No Box</label>
                    <input type="text" id="no_box" name="no_box"
                        class="form-control @error('no_box') is-invalid @enderror"
                        value="{{ old('no_box', $skck->no_box) }}" required>
                    @error('no_box')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- No Reg -->
                <div class="mb-3">
                    <label for="no_reg" class="form-label">No Reg</label>
                    <input type="text" id="no_reg" name="no_reg"
                        class="form-control @error('no_reg') is-invalid @enderror"
                        value="{{ old('no_reg', $skck->no_reg) }}" required>
                    @error('no_reg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah"
                        class="form-control @error('jumlah') is-invalid @enderror"
                        value="{{ old('jumlah', $skck->jumlah) }}" required>
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Keterangan -->
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $skck->keterangan) }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </div>
@endsection
