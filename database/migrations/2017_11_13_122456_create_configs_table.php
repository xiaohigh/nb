<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->comment('网站标题');
            $table->text('description')->nullable()->comment('网站关键字');
            $table->string('keywords')->nullable()->comment('关键字');
            $table->string('author_name')->nullable()->comment('作者昵称');
            $table->string('author_pic')->nullable()->comment('作者头像');
            $table->text('signature')->nullable()->comment('作者签名');
            $table->string('logo')->nullable()->comment('网站logo');
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
        Schema::dropIfExists('configs');
    }
}
