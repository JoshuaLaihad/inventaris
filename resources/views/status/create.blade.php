@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Halaman Tambah Data Status</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Tambah Data</a></li>
        <li class="breadcrumb-item active">Status</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Status</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('status.store') }}">
            @csrf
            <div class="mb-3">
                <label for="nama_status" class="form-label">Nama Status</label>
                <input type="text" name="nama_status" id="nama_status" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>


@endsection