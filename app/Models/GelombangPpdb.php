<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GelombangPpdb extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
    'nama_gelombang',
    'tahun_ajaran_id',
    'tahun_ajaran',
    'tanggal_mulai',
    'tanggal_selesai',
    'kuota',
    'status',
];

public function tahunAjaran()
{
    return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
}
}