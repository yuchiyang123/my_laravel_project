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
        Schema::table('company_apply', function (Blueprint $table) {
            $table->foreign(['user_id'], 'company_apply_ibfk_1')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_apply', function (Blueprint $table) {
            $table->dropForeign('company_apply_ibfk_1');
        });
    }
};
