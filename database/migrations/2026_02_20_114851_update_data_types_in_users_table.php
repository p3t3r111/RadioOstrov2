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
            // all_time_points
            // used_points
            // update these columns to be decimal instead of integer
            $table->decimal('all_time_points', 12, 4)->default(0)->change();
            $table->decimal('used_points', 12, 4)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('all_time_points')->default(0)->change();
            $table->integer('used_points')->default(0)->change();
        });
    }
};
