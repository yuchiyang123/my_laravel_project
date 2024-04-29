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
        Schema::table('mjoin_score', function (Blueprint $table) {
            $table->foreign(['rater_id'], 'mjoin_score_ibfk_1')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['evaluated_id'], 'mjoin_score_ibfk_2')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['article_id'], 'mjoin_score_ibfk_3')->references(['id'])->on('mjoin')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mjoin_score', function (Blueprint $table) {
            $table->dropForeign('mjoin_score_ibfk_1');
            $table->dropForeign('mjoin_score_ibfk_2');
            $table->dropForeign('mjoin_score_ibfk_3');
        });
    }
};
