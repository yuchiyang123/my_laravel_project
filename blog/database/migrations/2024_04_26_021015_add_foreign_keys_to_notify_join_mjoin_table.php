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
        Schema::table('notify_join_mjoin', function (Blueprint $table) {
            $table->foreign(['user_id'], 'notify_join_mjoin_ibfk_1')->references(['user_id'])->on('join_mjoin')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['article_id'], 'notify_join_mjoin_ibfk_2')->references(['article_id'])->on('join_mjoin')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notify_join_mjoin', function (Blueprint $table) {
            $table->dropForeign('notify_join_mjoin_ibfk_1');
            $table->dropForeign('notify_join_mjoin_ibfk_2');
        });
    }
};
