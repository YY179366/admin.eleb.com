<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackstagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backstages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('管理员名称');
            $table->string('email')->comment('邮箱账号');
            $table->string('password')->comment('密码');
            $table->rememberToken()->comment('token');
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
        Schema::dropIfExists('backstages');
    }
}
