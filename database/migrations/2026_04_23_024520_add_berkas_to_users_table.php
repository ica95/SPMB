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
        Schema::table('users', function (Blueprint $table) {
            $table->string('file_kk')->nullable();
            $table->string('file_akta')->nullable();
            $table->string('file_skl')->nullable();
            $table->string('file_foto')->nullable();
            $table->string('file_surat_sehat')->nullable();
            $table->string('file_surat_warna')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
