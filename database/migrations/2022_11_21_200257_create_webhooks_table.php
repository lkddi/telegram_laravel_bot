<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('update_id')->unique()->comment('id');
            $table->text('content')->nullable()->comment('内容');
            $table->string('type')->nullable()->comment('类型');
            $table->text('from_id')->nullable()->comment('发送者id');
            $table->text('from')->nullable()->comment('发送者信息');
            $table->text('chat_id')->nullable()->comment('来自群、好友的id');
            $table->text('chat')->nullable()->comment('来自哪里');
            $table->tinyInteger('state')->nullable()->default(0)->comment('状态');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webhooks');
    }
};
