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
        Schema::table('user_collections_shop', function (Blueprint $table) {
            $table->foreign(['user_id'], 'user_collections_shop_ibfk_1')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['article_id'], 'user_collections_shop_ibfk_2')->references(['id'])->on('shop')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_collections_shop', function (Blueprint $table) {
            $table->dropForeign('user_collections_shop_ibfk_1');
            $table->dropForeign('user_collections_shop_ibfk_2');
        });
    }
};
