<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'status_pendaftaran')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('status_pendaftaran')->default('menunggu');
            });
        }

        if (!Schema::hasColumn('users', 'status_final')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('status_final')->default('belum_final');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'status_pendaftaran')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('status_pendaftaran');
            });
        }

        if (Schema::hasColumn('users', 'status_final')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('status_final');
            });
        }
    }
};