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
            // votes
            $table->unsignedBigInteger('votes')->default(0)->after('voted');
            $table->unsignedInteger('invited_people')->default(0)->after('votes');
            $table->unsignedInteger('vote_weight')->default(1)->after('invited_people');
            $table->unsignedInteger('max_favorite_songs')->default(5)->after('vote_weight');
            $table->unsignedInteger('max_votes_per_day')->default(1)->after('max_favorite_songs');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('votes');
            $table->dropColumn('invited_people');
            $table->dropColumn('vote_weight');
            $table->dropColumn('max_favorite_songs');
            $table->dropColumn('max_votes_per_day');
        });
    }
};
