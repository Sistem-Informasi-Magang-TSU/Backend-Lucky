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
        Schema::create('mahasiswa', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();

    $table->string('nim', 10)->unique();
    $table->enum('prodi', [
        'informatika',
        'sistem_informasi',
        'teknik_komputer',
        'rekayasa_perangkat_lunak'
    ]);

    $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
    $table->string('nomor_telepon', 15)->nullable();
    $table->string('posisi', 50)->nullable();
    $table->boolean('riwayat_magang')->nullable();
    $table->string('foto', 100)->nullable();
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
