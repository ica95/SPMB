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
        Schema::create('biodata_calon_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('program_keahlian_id')->nullable();
            $table->foreignId('tahun_ajaran_id')->nullable();
            $table->foreignId('gelombang_ppdb_id')->nullable();

            $table->string('nama_lengkap');
            $table->string('nisn')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('agama')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->text('alamat')->nullable();
            $table->string('rumah_tinggal')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->text('alamat_asal_sekolah')->nullable();

            $table->string('status_pembayaran')->default('belum_bayar');
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamp('tanggal_pembayaran')->nullable();

            $table->string('file_kk')->nullable();
            $table->string('file_akta')->nullable();
            $table->string('file_skl')->nullable();
            $table->string('file_foto')->nullable();
            $table->string('file_surat_sehat')->nullable();
            $table->string('file_surat_warna')->nullable();

            $table->string('status_seleksi')->default('menunggu');
            $table->boolean('status_final')->default(false);
            $table->string('status_pendaftaran')->default('menunggu');
            $table->boolean('is_final')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata_calon_siswas');
    }
};
