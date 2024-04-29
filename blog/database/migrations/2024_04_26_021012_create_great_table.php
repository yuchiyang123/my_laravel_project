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
        Schema::create('great', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('reply_id');
            $table->string('clickgood_u');
            $table->string('clickgood_e');
            $table->string('great_code');
            $table->integer('many');
            $table->string('status', 50);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('great');
    }
};
