<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table)
        {
            $table->id()->unsigned();
            $table->longText('title');
            $table->longText('text');
            $table->string('img_title',250);
            $table->string('location',2);
            $table->integer('id_user');
            $table->timestamps();
            $table->SoftDeletes();
        });

        Schema::table('news', function($table)
        {
          $table->unsignedBigInteger('news_category_id');
          $table->foreign('news_category_id')->references('id')->on('news_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
