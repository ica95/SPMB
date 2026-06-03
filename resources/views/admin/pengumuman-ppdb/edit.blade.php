@extends('layouts.adminlte')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Edit Pengumuman</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.pengumuman-ppdb.update', $pengumuman->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Judul</label>

                <input type="text"
                       name="judul"
                       class="form-control"
                       value="{{ $pengumuman->judul }}">
            </div>

            <div class="mb-3">
                <label>Isi Pengumuman</label>

                <textarea name="isi"
                          class="form-control"
                          rows="5">{{ $pengumuman->isi }}</textarea>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>

                <input type="date"
                       name="tanggal"
                       class="form-control"
                       value="{{ $pengumuman->tanggal }}">
            </div>

            <div class="mb-3">
                <label>Status</label>

                <select name="status"
                        class="form-control">

                    <option value="publish"
                        {{ $pengumuman->status == 'publish' ? 'selected' : '' }}>
                        Publish
                    </option>

                    <option value="draft"
                        {{ $pengumuman->status == 'draft' ? 'selected' : '' }}>
                        Draft
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