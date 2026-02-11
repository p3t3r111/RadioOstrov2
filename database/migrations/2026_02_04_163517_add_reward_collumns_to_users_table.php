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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('all_time_points')->default(0)->after('max_votes_per_day');
            $table->integer('reserved_points')->default(0)->after('all_time_points');
            $table->integer('used_points')->default(0)->after('reserved_points');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('all_time_points');
            $table->dropColumn('reserved_points');
            $table->dropColumn('used_points');
        });
    }
};
