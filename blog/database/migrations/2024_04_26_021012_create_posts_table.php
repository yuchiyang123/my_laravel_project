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
        Schema::create('posts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->binary('image_data')->nullable();
            $table->string('image_type')->nullable();
            $table->string('title');
            $table->text('description');
            $table->string('slug')->nullable();
            $table->string('posted_by');
            $table->timestamp('date')->useCurrentOnUpdate()->useCurrent();
            $table->string('state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
