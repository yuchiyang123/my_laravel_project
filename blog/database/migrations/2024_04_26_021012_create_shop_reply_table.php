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
        Schema::create('shop_reply', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('reply_id')->index('reply_id');
            $table->string('name_e', 256);
            $table->string('name_u');
            $table->longText('main');
            $table->integer('good');
            $table->string('status', 50);
            $table->string('level');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_reply');
    }
};
