<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ppdbs', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->string('nama');
            $table->string('nik');
            $table->string('jenis_kelamin');
            $table->string('npsn');
            $table->string('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('asal_sekolah');
            $table->string('kab_kota_asal_sekolah');
            $table->string('agama');
            $table->string('golongan_darah');
            $table->string('hobi_kegemaran');
            $table->string('Jml_saudara_kandung');
            $table->string('alamat_tinggal');
            $table->string('prestasi_yang_dicapai');
            $table->string('jurusan');
            $table->string('no_telp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdbs');
    }
};
