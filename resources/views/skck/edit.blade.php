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
        
                {{-- Dropdown Kesatuan --}}
                <div class="mb-3">
                    <label for="kesatuan_id" class="form-label">Kesatuan</label>
                    <select name="kesatuan_id" id="kesatuan_id" class="form-select">
                        <option value="" disabled selected>Pilih Kesatuan</option>
                        @foreach ($kesatuan as $item)
                            <option value="{{ $item->id }}"
                                {{ old('kesatuan_id', $skck->kesatuan_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kesatuan }}
                            </option>
                        @endforeach
                    </select>
                    @error('kesatuan_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                {{-- Dropdown Status --}}
                <div class="mb-3">
                    <label for="status_id" class="form-label">Status</label>
                    <select name="status_id" id="status_id" class="form-select">
                        <option value="" disabled selected>Pilih Status</option>
                        @foreach ($status as $item)
                            <option value="{{ $item->id }}"
                                {{ old('status_id', $skck->status_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_status }}
                            </option>
                        @endforeach
                    </select>
                    @error('status_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                {{-- Input Tanggal --}}
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control"
                        value="{{ old('tanggal', $skck->tanggal?->format('Y-m-d')) }}">
                    @error('tanggal')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                {{-- Input No Box --}}
                <div class="mb-3">
                    <label for="no_box" class="form-label">No Box</label>
                    <input type="text" name="no_box" id="no_box" class="form-control"
                        value="{{ old('no_box', $skck->no_box) }}">
                    @error('no_box')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                {{-- Input No Reg --}}
                <div class="mb-3">
                    <label for="no_reg" class="form-label">No Reg</label>
                    <input type="text" name="no_reg" id="no_reg" class="form-control"
                        value="{{ old('no_reg', $skck->no_reg) }}">
                    @error('no_reg')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                {{-- Input Jumlah --}}
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control"
                        value="{{ old('jumlah', $skck->jumlah) }}">
                    @error('jumlah')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                {{-- Input Keterangan --}}
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control">{{ old('keterangan', $skck->keterangan) }}</textarea>
                    @error('keterangan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                {{-- Tombol Submit --}}
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection