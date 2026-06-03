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
        Schema::table('biodata_calon_siswas', function (Blueprint $table) {
            $table->string('hobi_kegemaran')->nullable()->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodata_calon_siswas', function (Blueprint $table) {
            $table->dropColumn('hobi_kegemaran');
        });
    }
};
