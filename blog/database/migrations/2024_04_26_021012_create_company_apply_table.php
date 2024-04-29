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
        Schema::create('company_apply', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('user_id');
            $table->string('company_name');
            $table->string('phone_number', 70);
            $table->integer('uniform_numbers');
            $table->string('company_location');
            $table->string('county', 128);
            $table->string('applicant');
            $table->binary('image_data')->nullable();
            $table->string('image_type')->nullable();
            $table->binary('image_data1')->nullable();
            $table->string('image_type1')->nullable();
            $table->string('status');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_apply');
    }
};
