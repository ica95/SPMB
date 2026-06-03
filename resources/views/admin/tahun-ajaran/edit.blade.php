@extends('layouts.adminlte')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Edit Tahun Ajaran
        </h3>

    </div>

    <div class="card-body">

        <form action="{{ route('admin.tahun-ajaran.update', $tahunAjaran->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            {{-- TAHUN AJARAN --}}
            <div class="form-group mb-3">

                <label>Tahun Ajaran</label>

                <input type="text"
                       name="tahun_ajaran"
                       class="form-control"
                       value="{{ $tahunAjaran->tahun_ajaran }}"
                       required>

            </div>

            {{-- STATUS --}}
            <div class="form-group mb-3">

                <label>Status</label>

                <select name="is_active"
                        class="form-control">

                    <option value="1"
                        {{ $tahunAjaran->is_active == 1 ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="0"
                        {{ $tahunAjaran->is_active == 0 ? 'selected' : '' }}>
                        Nonaktif
                    </option>

                </select>

            </div>

            {{-- BUTTON --}}
            <button type="submit"
                    class="btn btn-success">

                Update

            </button>

            <a href="{{ route('admin.tahun-ajaran.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection