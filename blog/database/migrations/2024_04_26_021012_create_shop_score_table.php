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
        Schema::create('shop_score', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('rater_id')->index('rater_id');
            $table->integer('article_id')->index('article_id');
            $table->integer('evaluated_id')->index('evaluated_id');
            $table->tinyInteger('score');
            $table->string('tag')->nullable();
            $table->string('comments')->nullable();
            $table->string('status', 20);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_score');
    }
};
