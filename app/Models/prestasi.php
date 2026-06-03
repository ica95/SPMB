<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'tahun',
        'deskripsi',
        'tingkat',
        'kategori',
        'gambar',
    ];
}