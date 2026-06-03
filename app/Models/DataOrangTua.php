<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataOrangTua extends Model
{
    protected $table = 'data_orang_tuas';

    protected $fillable = [
        'user_id',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'nama_wali',
        'pekerjaan_wali',
        'no_hp_orangtua_wali',
        'alamat_wali',
    ];
}