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
        Schema::create('notify', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('postid', 40);
            $table->longText('main');
            $table->string('who');
            $table->string('towho', 50);
            $table->string('title', 60);
            $table->string('username', 40);
            $table->string('state', 50);
            $table->timestamp('time')->nullable()->useCurrent();
            $table->enum('addstatus', ['unread', 'read'])->nullable()->default('unread');
            $table->string('come_from');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notify');
    }
};
