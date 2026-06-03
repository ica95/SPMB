@extends('layouts.adminlte')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Tambah Pendaftar</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.ppdb.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control">
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>

                <select name="jenis_kelamin" class="form-control">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Agama</label>

                <select name="agama" class="form-control">
                    <option value="">-- Pilih --</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Program Keahlian</label>

                <input type="text"
                       name="program_keahlian"
                       class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

        </form>

    </div>
</div>

@endsection