@extends('layouts.adminlte')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Edit Jadwal SPMB</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.jadwal-ppdb.update', $jadwal->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Kegiatan</label>

                <input type="text"
                       name="nama_kegiatan"
                       class="form-control"
                       value="{{ $jadwal->nama_kegiatan }}">
            </div>

            <div class="mb-3">
                <label>Tanggal Mulai</label>

                <input type="date"
                       name="tanggal_mulai"
                       class="form-control"
                       value="{{ $jadwal->tanggal_mulai }}">
            </div>

            <div class="mb-3">
                <label>Tanggal Selesai</label>

                <input type="date"
                       name="tanggal_selesai"
                       class="form-control"
                       value="{{ $jadwal->tanggal_selesai }}">
            </div>

            <div class="mb-3">
                <label>Keterangan</label>

                <textarea name="keterangan"
                          class="form-control">{{ $jadwal->keterangan }}</textarea>
            </div>

            <div class="mb-3">
                <label>Status</label>

                <select name="status"
                        class="form-control">

                    <option value="aktif"
                        {{ $jadwal->status == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="nonaktif"
                        {{ $jadwal->status == 'nonaktif' ? 'selected' : '' }}>
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