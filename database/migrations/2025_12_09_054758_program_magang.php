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
        Schema::create('program_magang', function (Blueprint $table) {
            $table->char('id_program', 8)->primary();
            $table->string('nama_program', 100);
            $table->string('jenis_bkp', 50);
            $table->string('lokasi_penempatan', 254);
            $table->char('id_mitra', 8);
            $table->string('periode', 20);
            $table->integer('kuota')->nullable();
            $table->string('lokasi_penempatan');
            $table->text('syarat')->nullable();
            $table->text('deskripsi_silabus')->nullable();
            $table->text('dampak_program')->nullable();
            $table->foreign('id_mitra')->references('id_mitra')->on('mitra')->onDelete('cascade');
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
