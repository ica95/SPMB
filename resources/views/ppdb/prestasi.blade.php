@extends('layouts.app')

@section('title', 'Data Prestasi')

@section('content')
<section class="biodata-page">

@section('back')
<a href="{{ route('orangtua.create') }}" class="btn-back-icon">←</a>
@endsection

    @php $activeStep = 4; @endphp
    @include('ppdb.partials.stepbar')

    <div class="container">
        <div class="biodata-card">
            <h2>Form Data Prestasi</h2>

            <p>Tambahkan prestasi yang pernah diraih. Jika memiliki lebih dari satu prestasi, silakan tambah satu per satu.</p>

            <p class="form-info">
                Jika tidak memiliki prestasi, kamu boleh melewati tahap ini dan melanjutkan ke tahap berikutnya.
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

            {{-- ✅ FORM UTAMA (SATU SAJA) --}}
            <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-dua-kolom">

    <!-- KOLOM KIRI -->
    <div>

        <div class="form-group">
            <label>Judul Prestasi</label>
            <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Juara 1 Lomba Matematika">
        </div>

        <div class="form-group">
            <label>Tahun</label>
            <input type="number" name="tahun" value="{{ old('tahun') }}" placeholder="Contoh: 2024">
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4" placeholder="Contoh: Juara 1 tingkat provinsi">{{ old('deskripsi') }}</textarea>
        </div>

    </div>

    <!-- KOLOM KANAN -->
    <div>

        <div class="form-group">
            <label>Tingkat</label>
            <select name="tingkat">
                <option value="">-- Pilih Tingkat --</option>
                <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                <option value="Provinsi">Provinsi</option>
                <option value="Nasional">Nasional</option>
                <option value="Internasional">Internasional</option>
            </select>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori">
                <option value="">-- Pilih Kategori --</option>
                <option value="Akademik">Akademik</option>
                <option value="Non Akademik">Non Akademik</option>
                <option value="Olahraga">Olahraga</option>
                <option value="Seni">Seni</option>
                <option value="Keagamaan">Keagamaan</option>
                <option value="Organisasi">Organisasi</option>
                <option value="Teknologi">Teknologi</option>
                <option value="Bahasa">Bahasa</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div class="form-group">
            <label>Upload Sertifikat</label>
            <input type="file" name="gambar" accept=".jpg,.jpeg,.png">
        </div>

    </div>

</div>

                {{-- ✅ TOMBOL DALAM FORM --}}
                <div class="form-navigation">
                    <a href="{{ route('orangtua.create') }}" class="btn-back">← Kembali</a>

                    <button type="submit" class="btn-submit-prestasi">
                        Simpan Prestasi
                    </button>
                </div>
            </form>

            {{-- ✅ TOMBOL LEWATI (FORM TERPISAH) --}}
            <form action="{{ route('prestasi.skip') }}" method="POST" style="margin-top:15px;">
                @csrf
                <button type="submit" class="btn-skip">
                    Lewati (Tidak Ada Prestasi)
                </button>
            </form>

        </div>

        {{-- ✅ LIST PRESTASI --}}
        @if($prestasis->count())
            <div class="biodata-card mt-4">
                <h3>Daftar Prestasi</h3>

                <div class="prestasi-list">
                    @foreach($prestasis as $prestasi)
                        <div class="prestasi-item">
                            <div class="prestasi-content">
                                <h4>{{ $prestasi->judul }}</h4>
                                <p><strong>Tahun:</strong> {{ $prestasi->tahun }}</p>
                                <p><strong>Tingkat:</strong> {{ $prestasi->tingkat }}</p>
                                <p><strong>Kategori:</strong> {{ $prestasi->kategori }}</p>

                                @if($prestasi->deskripsi)
                                    <p><strong>Deskripsi:</strong> {{ $prestasi->deskripsi }}</p>
                                @endif

                                @if($prestasi->gambar)
                                    <img src="{{ asset('storage/' . $prestasi->gambar) }}" width="150">
                                @endif
                            </div>

                            {{-- DELETE --}}
                            <form action="{{ route('prestasi.destroy', $prestasi->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus prestasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete-prestasi">Hapus</button>
                            </form>
                        </div>
                    @endforeach
                </div>

                {{-- LANJUT --}}
                <div class="form-navigation" style="margin-top: 25px;">
                    <a href="{{ route('orangtua.create') }}" class="btn-back">← Kembali</a>

                    <a href="{{ route('berkas.create') }}" class="btn-skip">
                        Lanjut ke Upload Berkas →
                    </a>
                </div>
            </div>
        @endif

    </div>
</section>
@endsection