@extends('layouts.adminlte')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Tambah Gelombang SPMB</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.gelombang-ppdb.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">
                <label>Nama Gelombang</label>

                <input type="text"
                       name="nama_gelombang"
                       class="form-control"
                       placeholder="Contoh: Gelombang 1">
            </div>

            <div class="mb-3">
    <label>Tahun Ajaran</label>

    <select name="tahun_ajaran_id" class="form-control" required>
        <option value="">-- Pilih Tahun Ajaran --</option>

        @foreach($tahunAjarans as $tahun)
            <option value="{{ $tahun->id }}">
                {{ $tahun->tahun_ajaran }}
            </option>
        @endforeach
    </select>
</div>

            <div class="mb-3">
                <label>Tanggal Mulai</label>

                <input type="date"
                       name="tanggal_mulai"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Tanggal Selesai</label>

                <input type="date"
                       name="tanggal_selesai"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Kuota</label>

                <input type="number"
                       name="kuota"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Status</label>

                <select name="status"
                        class="form-control">

                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>

                </select>
            </div>

            <button type="submit"
                    class="btn btn-primary">

                Simpan
            </button>

        </form>

    </div>
</div>

@endsection