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
        Schema::create('join_mjoin', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('user_id');
            $table->integer('article_id')->index('article_id');
            $table->string('sex', 25);
            $table->date('age');
            $table->string('preferences', 150);
            $table->string('foodallergy', 150);
            $table->string('languages', 20);
            $table->string('license', 15);
            $table->string('contact_method', 25);
            $table->longText('editor');
            $table->string('status', 80);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('join_mjoin');
    }
};
