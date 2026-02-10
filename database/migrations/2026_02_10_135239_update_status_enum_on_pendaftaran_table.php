<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'diterima', 'ditolak', 'lulus'])
                ->default('menunggu')
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])
                ->default('menunggu')
                ->change();
        });
    }
};
