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
        Schema::table('artwork', function (Blueprint $table) {
            $table->foreign(['user_id'], 'artwork_ibfk_1')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['user_id'], 'artwork_ibfk_2')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artwork', function (Blueprint $table) {
            $table->dropForeign('artwork_ibfk_1');
            $table->dropForeign('artwork_ibfk_2');
        });
    }
};
