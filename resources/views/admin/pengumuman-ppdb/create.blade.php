@extends('layouts.adminlte')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Tambah Pengumuman</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.pengumuman-ppdb.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">
                <label>Judul</label>

                <input type="text"
                       name="judul"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Isi Pengumuman</label>

                <textarea name="isi"
                          class="form-control"
                          rows="5"></textarea>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>

                <input type="date"
                       name="tanggal"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Status</label>

                <select name="status"
                        class="form-control">

                    <option value="publish">Publish</option>
                    <option value="draft">Draft</option>

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