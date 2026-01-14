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
        Schema::create('bimbingan_magang', function (Blueprint $table) {
            $table->id();

            $table->char('nuptk', 10);
            $table->string('nim', 10);

            $table->timestamps();

            $table->foreign('nuptk')
                ->references('nuptk')
                ->on('dosen')
                ->cascadeOnDelete();

            $table->foreign('nim')
                ->references('nim')
                ->on('mahasiswa')
                ->cascadeOnDelete();

            $table->unique(['nuptk', 'nim']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bimbingan_magang');
    }
};
