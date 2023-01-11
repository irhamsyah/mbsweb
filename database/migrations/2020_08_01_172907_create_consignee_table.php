<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsigneeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consignee', function (Blueprint $table) {
          $table->id();
          $table->string('code_consignee',10);
          $table->string('name_consignee',50);
          $table->longText('address_invoice');
          $table->longText('address');
          $table->integer('id_city');
          $table->string('postal',11);
          $table->string('telp',20);
          $table->string('fax',20);
          $table->string('npwp',50);
          $table->string('pkp_no',50);
          $table->longText('desc_consignee');
          $table->integer('payment_term');
          $table->string('name_person',50);
          $table->string('phone_person',50);
          $table->string('email_person',30);
          $table->string('fax_person',30);
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
        Schema::dropIfExists('consignee');
    }
}
