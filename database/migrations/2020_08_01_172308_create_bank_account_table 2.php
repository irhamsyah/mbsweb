<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_account', function (Blueprint $table) {
          $table->id()->unsigned();
          $table->string('bank_name',50);
          $table->string('bank_account',50);
          $table->string('branch',50);
          $table->string('account_name',100);
          $table->longText('bank_address');
          $table->timestamps();
          $table->SoftDeletes();
        });

        Schema::table('bank_account', function($table)
        {
          $table->unsignedBigInteger('agent_id');
          $table->foreign('agent_id')->references('id')->on('agent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_account');
    }
}
