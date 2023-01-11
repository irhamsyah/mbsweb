<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimoniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('testimoni', function (Blueprint $table) {
        $table->id();
        $table->string('name', 50);
        $table->string('position', 100);
        $table->longText('testimoni');
        $table->string('img_testimoni',250);
        $table->integer('id_user');
        $table->timestamps();
        $table->SoftDeletes();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testimoni');
    }
}
