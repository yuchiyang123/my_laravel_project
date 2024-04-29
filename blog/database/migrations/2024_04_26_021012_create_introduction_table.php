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
        Schema::create('introduction', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('postid', 50);
            $table->string('username', 35);
            $table->longText('main');
            $table->string('towho', 50);
            $table->string('tousername', 35);
            $table->integer('toid');
            $table->string('title');
            $table->string('post_code');
            $table->string('state', 20);
            $table->timestamp('time')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('introduction');
    }
};
