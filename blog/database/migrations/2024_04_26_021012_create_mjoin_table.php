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
        Schema::create('mjoin', function (Blueprint $table) {
            $table->integer('id', true);
            $table->binary('image_data')->nullable();
            $table->string('image_type')->nullable();
            $table->string('title');
            $table->string('destination');
            $table->string('time');
            $table->integer('diffDay');
            $table->string('people')->nullable();
            $table->string('money');
            $table->string('sex', 50)->nullable();
            $table->string('skill', 50)->nullable();
            $table->string('age', 50)->nullable();
            $table->longText('description');
            $table->string('posted_by_e');
            $table->string('posted_by_u');
            $table->timestamp('date')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->string('status', 15);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mjoin');
    }
};
