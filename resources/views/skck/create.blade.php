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
        <form method="POST" action="{{ route('skck.store') }}">
            @csrf

            <div class="mb-3">
                <label for="kesatuan_id" class="form-label">Kesatuan</label>
                <select id="kesatuan_id" name="kesatuan_id" class="form-select">
                    @foreach ($kesatuan as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kesatuan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="status_id" class="form-label">Status</label>
                <select id="status_id" name="status_id" class="form-select">
                    @foreach ($status as $s)
                        <option value="{{ $s->id }}">{{ $s->nama_status }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="no_box" class="form-label">No Box</label>
                <input type="text" id="no_box" name="no_box" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="no_reg" class="form-label">No Reg</label>
                <input type="text" id="no_reg" name="no_reg" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea id="keterangan" name="keterangan" class="form-control" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

@endsection
