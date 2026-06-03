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
    Schema::table('tahun_ajarans', function (Blueprint $table) {
        $table->id();
        $table->string('tahun_ajaran');
        $table->boolean('is_active')->default(false)->after('tahun_ajaran');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('tahun_ajarans', function (Blueprint $table) {
        $table->dropColumn('is_active');
    });
}
};
