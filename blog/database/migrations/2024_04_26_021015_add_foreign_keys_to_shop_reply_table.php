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
        Schema::table('shop_reply', function (Blueprint $table) {
            $table->foreign(['reply_id'], 'shop_reply_ibfk_1')->references(['id'])->on('shop')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shop_reply', function (Blueprint $table) {
            $table->dropForeign('shop_reply_ibfk_1');
        });
    }
};
