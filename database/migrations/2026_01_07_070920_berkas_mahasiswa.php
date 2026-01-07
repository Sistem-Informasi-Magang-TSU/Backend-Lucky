<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('berkas_mahasiswa', function (Blueprint $table) {
            $table->id();

            // Relasi ke users
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // File paths
            $table->string('cv_file')->nullable();
            $table->string('transkrip_file')->nullable();
            $table->string('krs_file')->nullable();

            // Status opsional (siap untuk admin verifikasi)
            $table->boolean('is_verified')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berkas_mahasiswa');
    }
};
