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
        Schema::create('reply_artwork', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('reply_id')->nullable();
            $table->string('name_e', 150);
            $table->string('name_u', 150);
            $table->longText('main')->nullable();
            $table->string('status');
            $table->string('level');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reply_artwork');
    }
};
