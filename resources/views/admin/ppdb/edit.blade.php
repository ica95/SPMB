@extends('layouts.adminlte')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Edit Data Pendaftar</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.ppdb.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control"
                       value="{{ old('nama_lengkap', $data->nama_lengkap) }}">
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control"
                       value="{{ old('no_hp', $data->no_hp) }}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="text" name="eamail" class="form-control"
                       value="{{ old('email', $data->email) }}">
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control">{{ old('alamat', $data->alamat) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>

            <a href="{{ route('admin.ppdb.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>

@endsection