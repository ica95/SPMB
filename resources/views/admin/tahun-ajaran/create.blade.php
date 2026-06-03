@extends('layouts.adminlte')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Tambah Tahun Ajaran
        </h3>

    </div>

    <div class="card-body">

        <form action="{{ route('admin.tahun-ajaran.store') }}"
              method="POST">

            @csrf

            {{-- TAHUN AJARAN --}}
            <div class="form-group mb-3">

                <label>Tahun Ajaran</label>

                <input type="text"
                       name="tahun_ajaran"
                       class="form-control"
                       placeholder="Contoh: 2026/2027"
                       required>

            </div>

            {{-- STATUS --}}
            <div class="form-group mb-3">

                <label>Status</label>

                <select name="is_active"
                        class="form-control">

                    <option value="1">
                        Aktif
                    </option>

                    <option value="0">
                        Nonaktif
                    </option>

                </select>

            </div>

            {{-- BUTTON --}}
            <button type="submit"
                    class="btn btn-success">

                Simpan

            </button>

            <a href="{{ route('admin.tahun-ajaran.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection