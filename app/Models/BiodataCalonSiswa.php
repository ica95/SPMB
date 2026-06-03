<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiodataCalonSiswa extends Model
{
    protected $fillable = [
        'user_id',
        'tahun_ajaran_id',
        'gelombang_ppdb_id',
        'program_keahlian_id',

        'nama_lengkap',
        'nisn',
        'jenis_kelamin',
        'agama',
        'tempat_lahir',
        'tanggal_lahir',
        'golongan_darah',
        'hobi_kegemaran',
        'alamat',
        'rumah_tinggal',
        'no_hp',
        'asal_sekolah',
        'alamat_asal_sekolah',

        'status_daftar_ulang',
        'status_pembayaran',
        'bukti_pembayaran',
        'tanggal_pembayaran',

        'file_kk',
        'file_akta',
        'file_skl',
        'file_foto',
        'file_surat_sehat',
        'file_surat_warna',

        'status_seleksi',
        'status_final',
        'status_pendaftaran',
        'is_final',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }

    public function gelombangPpdb()
    {
        return $this->belongsTo(GelombangPpdb::class, 'gelombang_ppdb_id');
    }

    public function programKeahlian()
    {
        return $this->belongsTo(ProgramKeahlian::class, 'program_keahlian_id');
    }
}