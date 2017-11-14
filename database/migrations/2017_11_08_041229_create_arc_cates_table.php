<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArcCatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('arc_cates')) {
            //表不存在创建表
            Schema::create('arc_cates', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->comment('分类名称');
                $table->integer('pid')->comment('父级分类id');
                $table->string('path')->comment('分类路径');
                $table->timestamps();
            });
        }else{

        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('arc_cates');
    }
}
