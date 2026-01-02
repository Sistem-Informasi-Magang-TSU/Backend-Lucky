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
        Schema::create('logbook', function (Blueprint $table) {
            $table->id('id_logbook');
            $table->char('nim', 10);
            $table->char('id_program', 8);
            $table->date('tanggal');
            $table->text('aktivitas');
            $table->string('lampiran', 255)->nullable();
            $table->enum('pelaksanaan_kegiatan', ['individu','kelompok']);
            $table->enum('status_validasi', ['belum divalidasi', 'divalidasi'])->default('belum divalidasi');
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('id_program')->references('id_program')->on('program_magang')->onDelete('cascade');
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
