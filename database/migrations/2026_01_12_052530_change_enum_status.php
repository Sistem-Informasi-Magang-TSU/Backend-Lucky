<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE logbook 
            MODIFY status_validasi 
            ENUM('pending', 'disetujui') 
            NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE logbook 
            MODIFY status_validasi
            ENUM(('belum divalidasi', 'divalidasi') 
            NOT NULL
        ");
    }
};
