<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramKeahlian extends Model
{
    protected $fillable = [
        'nama_program',
        'gambar',
        'kuota',
        'status',
    ];
}