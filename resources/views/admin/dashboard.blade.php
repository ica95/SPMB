@extends('layouts.adminlte')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Selamat Datang</h3>
    </div>

    <div class="card-body">
        <h4>Selamat datang, {{ auth()->user()->name }}</h4>
        <p>Anda berhasil login sebagai <strong>Admin</strong>.</p>
    </div>
</div>

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-primary">
            <div class="inner">
                <h3>{{ $totalPendaftar }}</h3>
                <p>Total Pendaftar</p>
            </div>
            <div class="small-box-icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-success">
            <div class="inner">
                <h3>{{ $diterima }}</h3>
                <p>Diterima</p>
            </div>
            <div class="small-box-icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-danger">
            <div class="inner">
                <h3>{{ $ditolak }}</h3>
                <p>Ditolak</p>
            </div>
            <div class="small-box-icon">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-warning">
            <div class="inner">
                <h3>{{ $menunggu }}</h3>
                <p>Menunggu</p>
            </div>
            <div class="small-box-icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-info">
            <div class="inner">
                <h3>{{ $totalJurusan }}</h3>
                <p>Total Jurusan</p>
            </div>
            <div class="small-box-icon">
                <i class="fas fa-school"></i>
            </div>
        </div>
    </div>

</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Menu Admin</h3>
    </div>

    <div class="card-body">
        <a href="{{ route('admin.pembayaran') }}" class="btn btn-success">
            Verifikasi Pembayaran
        </a>
    </div>
</div>

@endsection