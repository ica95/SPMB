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
        if (!Schema::hasColumn('tahun_ajarans', 'is_active')) {
            Schema::table('tahun_ajarans', function (Blueprint $table) {
                $table->boolean('is_active')->default(false)->after('tahun_ajaran');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('tahun_ajarans', 'is_active')) {
            Schema::table('tahun_ajarans', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }
    }
};
