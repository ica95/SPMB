@extends('layouts.app')

@section('title', 'Review Pendaftaran')

@section('content')
<section class="biodata-page">

    @php $activeStep = 6; @endphp
    @include('ppdb.partials.stepbar')

    <div class="container">
        <div class="biodata-card">

            <h2>Review Data Pendaftaran</h2>

            <p>
                Silakan periksa seluruh data sebelum dikirim final.
                Setelah dikirim, data tidak dapat diubah kembali.
            </p>

            <div class="review-grid">
                <div class="review-column">

                    {{-- BIODATA --}}
                    <div class="review-box" style="margin-top:25px;">
                        <h3>1. Biodata Calon Siswa</h3>

                        <p><strong>Nama Lengkap:</strong> {{ $biodata->nama_lengkap ?? '-' }}</p>
                        <p><strong>NISN:</strong> {{ $biodata->nisn ?? '-' }}</p>
                        <p><strong>Jenis Kelamin:</strong> {{ $biodata->jenis_kelamin ?? '-' }}</p>
                        <p><strong>Agama:</strong> {{ $biodata->agama ?? '-' }}</p>
                        <p><strong>Tempat, Tanggal Lahir:</strong>
                            {{ $biodata->tempat_lahir ?? '-' }},
                            {{ $biodata->tanggal_lahir ?? '-' }}
                        </p>
                        <p><strong>Golongan Darah:</strong> {{ $biodata->golongan_darah ?? '-' }}</p>
                        <p><strong>Hobi:</strong> {{ $biodata->hobi_kegemaran ?? '-' }}</p>
                        <p><strong>Alamat:</strong> {{ $biodata->alamat ?? '-' }}</p>
                        <p><strong>Rumah Tinggal:</strong> {{ $biodata->rumah_tinggal ?? '-' }}</p>
                        <p><strong>No HP:</strong> {{ $biodata->no_hp ?? '-' }}</p>
                        <p><strong>Asal Sekolah:</strong> {{ $biodata->asal_sekolah ?? '-' }}</p>
                        <p><strong>Alamat Asal Sekolah:</strong> {{ $biodata->alamat_asal_sekolah ?? '-' }}</p>
                        <p><strong>Program Keahlian:</strong> {{ $biodata->programKeahlian->nama_program ?? '-' }}</p>

                        @if($biodata && !$biodata->is_final)
                            <a href="{{ route('biodata.edit') }}" class="btn-back">
                                Edit Biodata
                            </a>
                        @endif
                    </div>

                    {{-- ORANG TUA --}}
                    <div class="review-box" style="margin-top:25px;">
                        <h3>2. Data Orang Tua / Wali</h3>

                        <p><strong>Nama Ayah:</strong> {{ $orangtua->nama_ayah ?? '-' }}</p>
                        <p><strong>Pekerjaan Ayah:</strong> {{ $orangtua->pekerjaan_ayah ?? '-' }}</p>
                        <p><strong>Nama Ibu:</strong> {{ $orangtua->nama_ibu ?? '-' }}</p>
                        <p><strong>Pekerjaan Ibu:</strong> {{ $orangtua->pekerjaan_ibu ?? '-' }}</p>
                        <p><strong>Nama Wali:</strong> {{ $orangtua->nama_wali ?? '-' }}</p>
                        <p><strong>Pekerjaan Wali:</strong> {{ $orangtua->pekerjaan_wali ?? '-' }}</p>
                        <p><strong>No HP Orang Tua / Wali:</strong> {{ $orangtua->no_hp_orangtua_wali ?? '-' }}</p>
                        <p><strong>Alamat Orang Tua / Wali:</strong> {{ $orangtua->alamat_wali ?? '-' }}</p>

                        @if($biodata && !$biodata->is_final)
                            <a href="{{ route('orangtua.edit') }}" class="btn-back">
                                Edit Data Orang Tua
                            </a>
                        @endif
                    </div>

                </div>

                <div class="review-column">

                    {{-- PRESTASI --}}
                    <div class="review-box" style="margin-top:25px;">
                        <h3>3. Data Prestasi</h3>

                        @forelse($prestasis as $prestasi)
                            <p>
                                <strong>{{ $prestasi->judul ?? '-' }}</strong><br>
                                Tahun: {{ $prestasi->tahun ?? '-' }} |
                                Tingkat: {{ $prestasi->tingkat ?? '-' }} |
                                Kategori: {{ $prestasi->kategori ?? '-' }}
                            </p>
                        @empty
                            <p>Tidak ada prestasi.</p>
                        @endforelse

                        @if($biodata && !$biodata->is_final)
                            <a href="{{ route('prestasi.index') }}" class="btn-back">
                                Edit Prestasi
                            </a>
                        @endif
                    </div>

                    {{-- PEMBAYARAN --}}
                    <div class="review-box" style="margin-top:25px;">
                        <h3>4. Pembayaran</h3>

                        <p><strong>Status Pembayaran:</strong> {{ $biodata->status_pembayaran ?? '-' }}</p>

                        @if($biodata && $biodata->bukti_pembayaran)
                            <a href="{{ asset('storage/' . $biodata->bukti_pembayaran) }}"
                               target="_blank"
                               class="btn-submit">
                                Lihat Bukti Pembayaran
                            </a>
                        @else
                            <p>-</p>
                        @endif
                    </div>

                    {{-- BERKAS --}}
                    <div class="review-box" style="margin-top:25px;">
                        <h3>5. Berkas Upload</h3>

                        <p><strong>Kartu Keluarga:</strong></p>
                        @if($biodata && $biodata->file_kk)
                            <a href="{{ asset('storage/' . $biodata->file_kk) }}" target="_blank" class="btn-submit">Lihat KK</a>
                        @else
                            <p>-</p>
                        @endif

                        <p style="margin-top:15px;"><strong>Akta Kelahiran:</strong></p>
                        @if($biodata && $biodata->file_akta)
                            <a href="{{ asset('storage/' . $biodata->file_akta) }}" target="_blank" class="btn-submit">Lihat Akta</a>
                        @else
                            <p>-</p>
                        @endif

                        <p style="margin-top:15px;"><strong>SKL / Ijazah:</strong></p>
                        @if($biodata && $biodata->file_skl)
                            <a href="{{ asset('storage/' . $biodata->file_skl) }}" target="_blank" class="btn-submit">Lihat SKL</a>
                        @else
                            <p>-</p>
                        @endif

                        <p style="margin-top:15px;"><strong>Pas Foto:</strong></p>
                        @if($biodata && $biodata->file_foto)
                            <img src="{{ asset('storage/' . $biodata->file_foto) }}" width="160" style="border-radius:10px; border:1px solid #ccc;">
                        @else
                            <p>-</p>
                        @endif

                        <p style="margin-top:15px;"><strong>Surat Sehat:</strong></p>
                        @if($biodata && $biodata->file_surat_sehat)
                            <a href="{{ asset('storage/' . $biodata->file_surat_sehat) }}" target="_blank" class="btn-submit">Lihat Surat Sehat</a>
                        @else
                            <p>-</p>
                        @endif

                        <p style="margin-top:15px;"><strong>Surat Buta Warna:</strong></p>
                        @if($biodata && $biodata->file_surat_warna)
                            <a href="{{ asset('storage/' . $biodata->file_surat_warna) }}" target="_blank" class="btn-submit">Lihat Surat Buta Warna</a>
                        @else
                            <p>-</p>
                        @endif

                        @if($biodata && !$biodata->is_final)
                            <div style="margin-top:20px;">
                                <a href="{{ route('berkas.create') }}" class="btn-back">
                                    Upload Ulang Berkas
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            {{-- FINAL --}}
            <div class="form-navigation" style="margin-top:30px;">
                @if($biodata && !$biodata->is_final)

                    <a href="{{ route('berkas.create') }}" class="btn-back">← Kembali</a>

                    <form action="{{ route('ppdb.submitFinal') }}" method="POST" style="display:inline-block;"
                        onsubmit="return confirm('Pastikan semua data sudah benar. Setelah dikirim final, data tidak dapat diubah lagi. Lanjutkan?')">
                        @csrf
                        <button type="submit" class="btn-submit-final">Kirim Final →</button>
                    </form>

                @else

                    <a href="{{ route('siswa.masuk') }}" class="btn-back">← Dashboard Siswa</a>
                    <a href="{{ route('pendaftaran.cetakBukti') }}" class="btn-submit">Cetak Bukti Pendaftaran →</a>

                @endif
            </div>

        </div>
    </div>
</section>
@endsection