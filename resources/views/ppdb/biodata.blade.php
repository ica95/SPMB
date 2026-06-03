@extends('layouts.app')

@section('title', 'Form Biodata Calon Peserta')

@section('content')
<section class="biodata-page">

    @php
        $activeStep = 2;

        $isDummy = ($biodata->nisn ?? '') == '-';

        $namaLengkap = old('nama_lengkap', $biodata->nama_lengkap ?? '');
        $nisn = old('nisn', $isDummy ? '' : ($biodata->nisn ?? ''));
        $jenisKelamin = old('jenis_kelamin', $isDummy ? '' : ($biodata->jenis_kelamin ?? ''));
        $agamaValue = old('agama', $isDummy ? '' : ($biodata->agama ?? ''));
        $tempatLahir = old('tempat_lahir', $isDummy ? '' : ($biodata->tempat_lahir ?? ''));
        $tanggalLahir = old('tanggal_lahir', $isDummy ? '' : ($biodata->tanggal_lahir ?? ''));
        $golonganDarah = old('golongan_darah', $isDummy ? '' : ($biodata->golongan_darah ?? ''));
        $hobi = old('hobi_kegemaran', $isDummy ? '' : ($biodata->hobi_kegemaran ?? ''));
        $alamat = old('alamat', $isDummy ? '' : ($biodata->alamat ?? ''));
        $rumahTinggal = old('rumah_tinggal', $isDummy ? '' : ($biodata->rumah_tinggal ?? ''));
        $noHp = old('no_hp', $isDummy ? '' : ($biodata->no_hp ?? ''));
        $asalSekolah = old('asal_sekolah', $isDummy ? '' : ($biodata->asal_sekolah ?? ''));
        $alamatAsalSekolah = old('alamat_asal_sekolah', $isDummy ? '' : ($biodata->alamat_asal_sekolah ?? ''));
        $programId = old('program_keahlian_id', $isDummy ? '' : ($biodata->program_keahlian_id ?? ''));
    @endphp

    @include('ppdb.partials.stepbar')

    <div class="container">
        <div class="biodata-card">
            <h2>Form Biodata Calon Peserta</h2>
            <p>Silakan lengkapi biodata di bawah ini dengan benar dan lengkap.</p>

            @if(session('success'))
                <div class="alert-success-custom">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-error-custom">
                    {{ session('error') }}
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

            <form action="{{ route('biodata.store') }}" method="POST">
                @csrf

                <div class="form-dua-kolom">
                    <div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ $namaLengkap }}" required>
                        </div>

                        <div class="form-group">
                            <label>NISN</label>
                            <input type="text" name="nisn" value="{{ $nisn }}" required>
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                @foreach(['Laki-Laki', 'Perempuan'] as $jk)
                                    <option value="{{ $jk }}" {{ $jenisKelamin == $jk ? 'selected' : '' }}>
                                        {{ $jk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" required>
                                <option value="">-- Pilih Agama --</option>
                                @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'] as $agama)
                                    <option value="{{ $agama }}" {{ $agamaValue == $agama ? 'selected' : '' }}>
                                        {{ $agama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ $tempatLahir }}" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ $tanggalLahir }}" required>
                        </div>

                        <div class="form-group">
                            <label>Golongan Darah</label>
                            <select name="golongan_darah" required>
                                <option value="">-- Pilih Golongan Darah --</option>
                                @foreach(['A', 'B', 'AB', 'O'] as $goldar)
                                    <option value="{{ $goldar }}" {{ $golonganDarah == $goldar ? 'selected' : '' }}>
                                        {{ $goldar }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label>Hobi / Kegemaran</label>
                            <input type="text" name="hobi_kegemaran" value="{{ $hobi }}" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" rows="4" required>{{ $alamat }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Rumah Tinggal</label>
                            <select name="rumah_tinggal" required>
                                <option value="">-- Pilih Rumah Tinggal --</option>
                                @foreach(['Orang Tua', 'Wali', 'Kost', 'Panti Asuhan'] as $rt)
                                    <option value="{{ $rt }}" {{ $rumahTinggal == $rt ? 'selected' : '' }}>
                                        {{ $rt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>No. HP Calon Siswa</label>
                            <input type="text" name="no_hp" value="{{ $noHp }}" required>
                        </div>

                        <div class="form-group">
                            <label>Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" value="{{ $asalSekolah }}" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat Asal Sekolah</label>
                            <textarea name="alamat_asal_sekolah" rows="4" required>{{ $alamatAsalSekolah }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Pilihan Program Keahlian</label>
                            <select name="program_keahlian_id" class="form-control" required>
                                <option value="">-- Pilih Program Keahlian --</option>

                                @foreach($programKeahlian as $program)
                                    <option value="{{ $program->id }}" {{ $programId == $program->id ? 'selected' : '' }}>
                                        {{ $program->nama_program }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="btn-kanan">
                    <button type="submit" class="btn-submit-biodata">
                        Simpan Biodata
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection