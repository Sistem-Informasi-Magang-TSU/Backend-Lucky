<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dosen', function (Blueprint $table) {
            // Menambahkan field foto_dosen tipe string (nullable) di bawah kolom kontak
            $table->string('foto_dosen')->nullable()->after('kontak');
        });
    }

    public function down(): void
    {
        Schema::table('dosen', function (Blueprint $table) {
            // Menghapus field jika migration di-rollback
            $table->dropColumn('foto_dosen');
        });
    }
};