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
        Schema::create('shop_join', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 100);
            $table->integer('user_id')->index('user_id');
            $table->integer('article_id')->index('article_id');
            $table->string('email');
            $table->string('contact_number', 20);
            $table->string('job_type', 100)->nullable();
            $table->string('expected_salary', 100);
            $table->text('work_experience')->nullable();
            $table->text('personality');
            $table->text('educational_background')->nullable();
            $table->string('availability')->nullable();
            $table->string('driving_license', 50);
            $table->longText('motivation')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->string('status', 60);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_join');
    }
};
