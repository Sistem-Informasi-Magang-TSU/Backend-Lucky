<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('program_magang', function (Blueprint $table) {
            $table->string('lokasi_penempatan', 255)
                  ->after('kuota')
                  ->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('program_magang', function (Blueprint $table) {
            $table->dropColumn('lokasi_penempatan');
        });
    }
};
