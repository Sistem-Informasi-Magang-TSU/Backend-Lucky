<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('logbook', function (Blueprint $table) {
        // 1. Menghapus field (pastikan field 'tanggal' dan 'lampiran' memang ada)
        $table->dropColumn(['tanggal', 'lampiran','aktivitas']);

        // 2. Menambah field baru
        // Kita gunakan 'after' agar posisi kolom rapi setelah id_program
        $table->date('tanggal_mulai')->after('id_program');
        $table->date('tanggal_selesai')->after('tanggal_mulai');
        $table->string('nama_kegiatan')->after('tanggal_selesai');
        $table->string('uraian_kegiatan')->after('nama_kegiatan');
    });
}

public function down(): void
{
    Schema::table('logbook', function (Blueprint $table) {
        // Balikkan keadaan jika migration di-rollback
        $table->dropColumn(['tanggal_mulai', 'tanggal_selesai']);
        $table->date('tanggal');
        $table->string('lampiran')->nullable();
    });
}
};
