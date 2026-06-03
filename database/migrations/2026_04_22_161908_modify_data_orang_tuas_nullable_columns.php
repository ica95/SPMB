<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_orang_tuas', function (Blueprint $table) {
            $table->string('nama_ayah')->nullable()->change();
            $table->string('pekerjaan_ayah')->nullable()->change();
            $table->string('nama_ibu')->nullable()->change();
            $table->string('pekerjaan_ibu')->nullable()->change();
            $table->string('nama_wali')->nullable()->change();
            $table->string('pekerjaan_wali')->nullable()->change();
            $table->string('alamat_wali')->nullable()->change();
            $table->string('no_hp_orangtua_wali')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('data_orang_tuas', function (Blueprint $table) {
            $table->string('nama_ayah')->nullable(false)->change();
            $table->string('pekerjaan_ayah')->nullable(false)->change();
            $table->string('nama_ibu')->nullable(false)->change();
            $table->string('pekerjaan_ibu')->nullable(false)->change();
            $table->string('nama_wali')->nullable(false)->change();
            $table->string('pekerjaan_wali')->nullable(false)->change();
            $table->string('alamat_wali')->nullable(false)->change();
            $table->string('no_hp_orangtua_wali')->nullable(false)->change();
        });
    }
};