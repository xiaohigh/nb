<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tags')) {
            Schema::create('tags', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->comment('标签名')->unique();
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
        //Schema::dropIfExists('tags');
    }
}
