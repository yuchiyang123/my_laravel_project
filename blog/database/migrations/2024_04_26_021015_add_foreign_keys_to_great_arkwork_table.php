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
        Schema::table('great_arkwork', function (Blueprint $table) {
            $table->foreign(['user_id'], 'great_arkwork_ibfk_1')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['article_id'], 'great_arkwork_ibfk_2')->references(['id'])->on('artwork')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('great_arkwork', function (Blueprint $table) {
            $table->dropForeign('great_arkwork_ibfk_1');
            $table->dropForeign('great_arkwork_ibfk_2');
        });
    }
};
