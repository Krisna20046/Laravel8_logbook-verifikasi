@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid bg-primary text-white text-center">
    <div class="container">
        <h1 class="display-4">Selamat Datang di Logbook Harian</h1>
        <p class="lead">Catat dan kelola aktivitas harian Anda dengan mudah</p>
        <a href="{{ route('login') }}" class="btn btn-lg btn-light">Masuk</a>
        <a href="{{ route('register') }}" class="btn btn-lg btn-outline-light">Daftar Akun</a>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <!-- <img src="{{ asset('images/icon1.png') }}" class="card-img-top" alt="Icon 1"> -->
                <div class="card-body">
                    <h5 class="card-title">Catat Aktivitas Harian</h5>
                    <p class="card-text">Catat semua aktivitas harian Anda dengan detail dan keterangan yang jelas.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <!-- <img src="{{ asset('images/icon2.png') }}" class="card-img-top" alt="Icon 2"> -->
                <div class="card-body">
                    <h5 class="card-title">Pantau Proses Persetujuan</h5>
                    <p class="card-text">Lihat status persetujuan logbook harian Anda oleh atasan Anda.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <!-- <img src="{{ asset('images/icon3.png') }}" class="card-img-top" alt="Icon 3"> -->
                <div class="card-body">
                    <h5 class="card-title">Laporan Harian yang Jelas</h5>
                    <p class="card-text">Dapatkan laporan harian yang jelas dan teratur untuk melihat kemajuan Anda.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@auth
@if(auth()->user()->role === 'Admin')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card">
            <!-- <img src="{{ asset('images/icon4.png') }}" class="card-img-top" alt="Icon 3"> -->
            <div class="card-body">
                <h5 class="card-title">Kelola Pengguna Anda</h5>
                <p class="card-text">Tambah, Edit, dan Delete pengguna anda dengan mudah</p>
                <a href="{{ route('users.index') }}" class="btn btn-primary">Daftar Pengguna</a>
                <a href="{{ route('users.create') }}" class="btn btn-success">Tambah Pengguna Baru</a>
            </div>
        </div>
    </div>
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pengelolaan Pengguna</div>

                <div class="card-body">
                    <a href="{{ route('users.index') }}" class="btn btn-primary">Daftar Pengguna</a>
                    <a href="{{ route('users.create') }}" class="btn btn-success">Tambah Pengguna Baru</a>
                </div>
            </div>
        </div>
    </div> -->
</div>
@endif
@endauth
@endsection
