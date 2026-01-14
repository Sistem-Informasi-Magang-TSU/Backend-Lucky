<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('dosen')->truncate();
        
        if (Schema::hasColumn('dosen', 'user_id')) {
            Schema::table('dosen', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
        
        Schema::enableForeignKeyConstraints();
        
        Schema::table('dosen', function (Blueprint $table) {
            $table->foreignId('user_id')->after('nuptk')->constrained('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
