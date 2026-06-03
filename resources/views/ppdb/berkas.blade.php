@extends('layouts.app')

@section('title', 'Upload Berkas Persyaratan')

@section('content')
<section class="biodata-page">

    @php $activeStep = 5; @endphp
    @include('ppdb.partials.stepbar')

    <div class="container">
        <div class="biodata-card">
            <h2>Upload Berkas Persyaratan</h2>
            <p>Silakan upload semua dokumen persyaratan SPMB.</p>

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

            <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Upload KK</label>
                    @if(isset($biodata) && $biodata->file_kk)
                        <p><small>Berkas saat ini: <a href="{{ asset('storage/' . $biodata->file_kk) }}" target="_blank">Lihat File</a></small></p>
                    @endif
                    <input type="file" name="file_kk" accept=".jpg,.jpeg,.png,.pdf" {{ (isset($biodata) && $biodata->file_kk) ? '' : 'required' }}>
                </div>

                <div class="form-group">
                    <label>Upload Akta Kelahiran</label>
                    @if(isset($biodata) && $biodata->file_akta)
                        <p><small>Berkas saat ini: <a href="{{ asset('storage/' . $biodata->file_akta) }}" target="_blank">Lihat File</a></small></p>
                    @endif
                    <input type="file" name="file_akta" accept=".jpg,.jpeg,.png,.pdf" {{ (isset($biodata) && $biodata->file_akta) ? '' : 'required' }}>
                </div>

                <div class="form-group">
                    <label>Upload Surat Keterangan Lulus</label>
                    @if(isset($biodata) && $biodata->file_skl)
                        <p><small>Berkas saat ini: <a href="{{ asset('storage/' . $biodata->file_skl) }}" target="_blank">Lihat File</a></small></p>
                    @endif
                    <input type="file" name="file_skl" accept=".jpg,.jpeg,.png,.pdf" {{ (isset($biodata) && $biodata->file_skl) ? '' : 'required' }}>
                </div>

                <div class="form-group">
                    <label>Upload Surat Keterangan Sehat</label>
                    @if(isset($biodata) && $biodata->file_surat_sehat)
                        <p><small>Berkas saat ini: <a href="{{ asset('storage/' . $biodata->file_surat_sehat) }}" target="_blank">Lihat File</a></small></p>
                    @endif
                    <input type="file" name="file_surat_sehat" accept=".jpg,.jpeg,.png,.pdf" {{ (isset($biodata) && $biodata->file_surat_sehat) ? '' : 'required' }}>
                </div>

                <div class="form-group">
                    <label>Upload Surat Keterangan Buta Warna</label>
                    @if(isset($biodata) && $biodata->file_surat_warna)
                        <p><small>Berkas saat ini: <a href="{{ asset('storage/' . $biodata->file_surat_warna) }}" target="_blank">Lihat File</a></small></p>
                    @endif
                    <input type="file" name="file_surat_warna" accept=".jpg,.jpeg,.png,.pdf" {{ (isset($biodata) && $biodata->file_surat_warna) ? '' : 'required' }}>
                </div>

                <div class="form-group">
                    <label>Upload Foto</label>
                    @if(isset($biodata) && $biodata->file_foto)
                        <p><small>Berkas saat ini: <a href="{{ asset('storage/' . $biodata->file_foto) }}" target="_blank">Lihat File</a></small></p>
                    @endif
                    <input type="file" name="file_foto" accept=".jpg,.jpeg,.png" {{ (isset($biodata) && $biodata->file_foto) ? '' : 'required' }}>
                </div>

                <div class="form-navigation">
                    <a href="{{ route('prestasi.index') }}" class="btn-back">← Kembali</a>

                    <div class="alert-info-berkas">
                        <strong>Perhatian:</strong>
                        <ul>
                            <li>Format file: JPG, JPEG, PNG, PDF.</li>
                            <li>Ukuran maksimal setiap file adalah 2 MB.</li>
                            <li>Pastikan file terlihat jelas dan tidak blur.</li>
                        </ul>
                    </div>
                    
                    <button type="submit" class="btn-submit-berkas">
                        Simpan Berkas
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection