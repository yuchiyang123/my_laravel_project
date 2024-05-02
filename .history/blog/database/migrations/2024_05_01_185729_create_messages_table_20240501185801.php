<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('receiver_id');
            $table->text('message'); // 增加一個消息內容欄位
            $table->boolean('is_read')->default(false); // 狀態欄位，默認為未讀
            $table->timestamps(); // 包含 created_at 和 updated_at

            // 外鍵約束
            $table->foreign('user_id')->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
