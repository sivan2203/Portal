<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
//            $table->integer('autor_id')->unsigned();
            $table->string('title');
            $table->text('content');
            $table->timestamps();

        });

//        Schema::table('articles', function(Blueprint $table) {
//            $table->foreign('autor_id')->references('id')->on('people');
//        });
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
