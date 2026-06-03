@extends('layouts.app')

@section('title', 'Data Orang Tua / Wali')

@section('content')
<section class="biodata-page">

@section('back')
<a href="{{ route('home') }}" class="btn-back-icon">←</a>
@endsection

    @php $activeStep = 3; @endphp
    @include('ppdb.partials.stepbar')

    <div class="container">
        <div class="biodata-card">
            <h2>Form Data Orang Tua / Wali</h2>
            <p>Silakan lengkapi data orang tua atau wali calon peserta di bawah ini.</p>
            <p class="form-info">
                Isi data Ayah dan Ibu jika ada.  
                Jika tidak memiliki wali, kolom wali boleh dikosongkan.  
                Jika tinggal bersama wali, wajib mengisi data wali, nomor HP, dan alamat wali.
            </p>

            @if(session('success'))
                <div class="alert-success-custom">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-error-custom">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('orangtua.store') }}" method="POST">
                @csrf

                <div class="form-dua-kolom">
                <div>

                <div class="form-group">
                    <label>Nama Ayah</label>
                    <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $dataOrangTua->nama_ayah ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Pekerjaan Ayah</label>
                    <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $dataOrangTua->pekerjaan_ayah ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Nama Ibu</label>
                    <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $dataOrangTua->nama_ibu ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Pekerjaan Ibu</label>
                    <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $dataOrangTua->pekerjaan_ibu ?? '') }}">
                </div>

            </div>

              <div>

                <div class="form-group">
                    <label>Nama Wali</label>
                    <input type="text" name="nama_wali" value="{{ old('nama_wali', $dataOrangTua->nama_wali ?? '') }}">
                </div>

                <div class="form-group">
                    <label>Pekerjaan Wali</label>
                    <input type="text" name="pekerjaan_wali" value="{{ old('pekerjaan_wali', $dataOrangTua->pekerjaan_wali ?? '') }}">
                </div>

                <div class="form-group">
                    <label>No. HP Orang Tua / Wali</label>
                    <input type="text" name="no_hp_orangtua_wali" value="{{ old('no_hp_orangtua_wali', $dataOrangTua->no_hp_orangtua_wali ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label>Alamat Wali</label>
                    <textarea name="alamat_wali" rows="4">{{ old('alamat_wali', $dataOrangTua->alamat_wali ?? '') }}</textarea>
                </div>
                
                            <div class="btn-kanan">
                    <button type="submit" class="btn-submit-biodata">
                        Simpan Data Orang Tua / Wali
                    </button>
                </div>

            </div>
        </div>
    </form>

        </div>
    </div>
</section>
@endsection