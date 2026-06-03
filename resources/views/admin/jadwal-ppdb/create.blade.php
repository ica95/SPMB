@extends('layouts.adminlte')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Tambah Jadwal SPMB</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.jadwal-ppdb.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">
                <label>Nama Kegiatan</label>

                <input type="text"
                       name="nama_kegiatan"
                       class="form-control"
                       placeholder="Contoh: Tes Seleksi">
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
                <label>Keterangan</label>

                <textarea name="keterangan"
                          class="form-control"></textarea>
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