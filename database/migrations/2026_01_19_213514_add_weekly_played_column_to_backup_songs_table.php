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
        Schema::table('backup_songs', function (Blueprint $table) {
            $table->boolean('weekly_played')->after('user')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('backup_songs', function (Blueprint $table) {
            $table->dropColumn('weekly_played');
        });
    }
};
