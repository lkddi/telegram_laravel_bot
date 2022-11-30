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
        Schema::create('t_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->onDelete('cascade')->comment('群id');
            $table->string('user_id')->comment('用户id');
            $table->string('first_name')->nullable()->comment('名');
            $table->string('last_name')->nullable()->comment('性');
            $table->string('username')->nullable()->comment('用户名');
            $table->string('state')->nullable()->default(0)->comment('验证状态');
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
        Schema::dropIfExists('t_users');
    }
};
