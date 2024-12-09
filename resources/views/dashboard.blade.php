@extends('layouts.app')

@section('content')

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<!-- Jumbotron Section -->
<div class="jumbotron bg-light p-5 rounded mt-4">
  <h1 class="display-4">Selamat Datang!</h1>
  <p class="lead">Anda telah mengakses website inventaris SKCK. Gunakan sistem ini untuk mengelola dan memantau inventaris dengan mudah dan efisien.</p>
  <hr class="my-4">
  <p>Jelajahi fitur kami untuk mendukung proses administrasi Anda.</p>
  <a class="btn btn-primary btn-lg" href="#features" role="button">Lihat Fitur</a>
</div>

@endsection
