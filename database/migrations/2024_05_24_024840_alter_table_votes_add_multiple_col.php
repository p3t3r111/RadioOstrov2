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
        Schema::table('votes', function (Blueprint $table) {
            $table->string('username')->after('users_id');
            $table->string('songName')->after('username');
            $table->string('songAuthor')->after('songName');
            $table->string('songImgPath')->after('songAuthor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('songName');
            $table->dropColumn('songAuthor');
            $table->dropColumn('songImgPath');
        });
    }
};
