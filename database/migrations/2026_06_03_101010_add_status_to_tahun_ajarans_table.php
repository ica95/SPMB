<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tahun_ajarans', function (Blueprint $table) {
            if (!Schema::hasColumn('tahun_ajarans', 'status')) {
                $table->string('status', 20)->default('nonaktif')->after('is_active');
            }
        });

        DB::table('tahun_ajarans')
            ->where('is_active', 1)
            ->update(['status' => 'aktif']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tahun_ajarans', function (Blueprint $table) {
            if (Schema::hasColumn('tahun_ajarans', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
