<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->integer('autor_id')->unsigned();
            $table->text('body');
            $table->timestamps();


        });
        Schema::table('articles', function(Blueprint $table) {
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('autor_id')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
