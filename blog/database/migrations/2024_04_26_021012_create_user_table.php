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
        Schema::create('user', function (Blueprint $table) {
            $table->integer('id', true);
            $table->binary('profileImage')->nullable();
            $table->string('profileImage_type', 50)->nullable();
            $table->string('username', 30)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('password')->nullable();
            $table->integer('permissions')->nullable();
            $table->string('sex', 70);
            $table->date('age')->nullable();
            $table->string('state', 50);
            $table->string('verify', 50);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
