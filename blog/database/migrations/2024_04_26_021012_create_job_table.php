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
        Schema::create('job', function (Blueprint $table) {
            $table->integer('id', true);
            $table->binary('image_data')->nullable();
            $table->string('image_type')->nullable();
            $table->string('title');
            $table->string('name');
            $table->integer('age');
            $table->string('education');
            $table->string('driving_license');
            $table->string('languages');
            $table->string('accommodation_type');
            $table->text('work_experience');
            $table->string('preferred_time');
            $table->string('expected_salary');
            $table->text('self_description');
            $table->string('whopost');
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->string('state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job');
    }
};
