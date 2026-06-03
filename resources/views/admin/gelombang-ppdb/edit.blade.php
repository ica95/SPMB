@extends('layouts.adminlte')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Edit Gelombang SPMB</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.gelombang-ppdb.update', $gelombang->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Gelombang</label>

                <input type="text"
                       name="nama_gelombang"
                       class="form-control"
                       value="{{ $gelombang->nama_gelombang }}">
            </div>

            <div class="mb-3">
    <label>Tahun Ajaran</label>

    <select name="tahun_ajaran_id" class="form-control" required>
        <option value="">-- Pilih Tahun Ajaran --</option>

        @foreach($tahunAjarans as $tahun)
            <option value="{{ $tahun->id }}"
                {{ $gelombang->tahun_ajaran_id == $tahun->id ? 'selected' : '' }}>
                {{ $tahun->tahun_ajaran }}
            </option>
        @endforeach
    </select>
</div>

            <div class="mb-3">
                <label>Tanggal Mulai</label>

                <input type="date"
                       name="tanggal_mulai"
                       class="form-control"
                       value="{{ $gelombang->tanggal_mulai }}">
            </div>

            <div class="mb-3">
                <label>Tanggal Selesai</label>

                <input type="date"
                       name="tanggal_selesai"
                       class="form-control"
                       value="{{ $gelombang->tanggal_selesai }}">
            </div>

            <div class="mb-3">
                <label>Kuota</label>

                <input type="number"
                       name="kuota"
                       class="form-control"
                       value="{{ $gelombang->kuota }}">
            </div>

            <div class="mb-3">
                <label>Status</label>

                <select name="status"
                        class="form-control">

                    <option value="aktif"
                        {{ $gelombang->status == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="nonaktif"
                        {{ $gelombang->status == 'nonaktif' ? 'selected' : '' }}>
                        Nonaktif
                    </option>

                </select>
            </div>

            <button type="submit"
                    class="btn btn-primary">

                Update
            </button>

        </form>

    </div>
</div>

@endsection