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
        Schema::create('shop', function (Blueprint $table) {
            $table->integer('id', true);
            $table->binary('image_data')->nullable();
            $table->string('image_type')->nullable();
            $table->string('shop_name');
            $table->string('selectwhere', 50);
            $table->string('business_registration_number');
            $table->string('location');
            $table->string('driver_license_requirements');
            $table->string('recruitment_period');
            $table->string('sex', 50);
            $table->string('language');
            $table->text('conditions_exp');
            $table->text('work_hours');
            $table->longText('job_description');
            $table->text('benefits');
            $table->longText('shop_information');
            $table->string('posted_by_u');
            $table->string('posted_by_e');
            $table->string('status', 80);
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop');
    }
};
