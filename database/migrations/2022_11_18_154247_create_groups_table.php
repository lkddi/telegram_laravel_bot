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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id')->comment('ID');
            $table->string('title')->nullable()->comment('昵称');
            $table->string('username')->nullable()->comment('用户名');
            $table->string('type')->nullable()->comment('类型');//“private”, “group”, “supergroup” or “channel”
            $table->string('invite_link')->nullable()->comment('链接');
            $table->string('status')->nullable()->comment('群属性');
            $table->tinyInteger('open')->default(0)->comment('总开关');
            $table->string('vmethod')->default('active')->comment('验证方式');
            $table->integer('overtime')->default(300)->comment('超时时间');
            $table->string('verror')->default('banChatSenderChat')->comment('验证错误处理方式');
            $table->integer('passedconut')->default(0)->comment('通过数');
            $table->integer('errorconut')->default(0)->comment('失败数');
            $table->tinyInteger('can_be_edited')->nullable()->default(0)->comment('权限');
            $table->tinyInteger('can_manage_chat')->nullable()->default(0)->comment('权限');
            $table->tinyInteger('can_change_info')->nullable()->default(0)->comment('权限');
            $table->tinyInteger('can_delete_messages')->nullable()->default(0)->comment('权限');
            $table->tinyInteger('can_invite_users')->nullable()->default(0)->comment('权限');
            $table->tinyInteger('can_restrict_members')->nullable()->default(0)->comment('权限');
            $table->tinyInteger('can_pin_messages')->nullable()->default(0)->comment('权限');
            $table->tinyInteger('can_manage_topics')->nullable()->default(0)->comment('权限');
            $table->tinyInteger('can_promote_members')->nullable()->default(0)->comment('权限');
            $table->tinyInteger('can_manage_video_chats')->nullable()->default(0)->comment('权限');
            $table->tinyInteger('is_anonymous')->nullable()->default(0)->comment('权限');
            $table->tinyInteger('can_manage_voice_chats')->nullable()->default(0)->comment('权限');
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
        Schema::dropIfExists('groups');
    }
};
