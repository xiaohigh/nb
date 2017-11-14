<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //如果表不存在 则创建表
        if (!Schema::hasTable('articles')) {
            //
            Schema::create('articles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->comment('文章标题');
                $table->string('pic')->comment('文章的头图');
                $table->text('markdown') -> comment('markdown内容');
                $table->text('intro') -> comment('摘要');
                $table->text('content') -> comment('html内容');
                $table->enum('type', ['mark','html'])->comment('内容的格式');
                $table->integer('cate_id')->comment('内容的分类');

                $table->timestamps();
            });
        }else{
            //表存在则更改表
            Schema::table('articles', function (Blueprint $table) {
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
