<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
          $table->id();
          $table->string('code_customer',10);
          $table->string('name_customer',50);
          $table->longText('address_invoice');
          $table->longText('address');
          $table->integer('id_city');
          $table->integer('entity_id');
          $table->string('postal',11);
          $table->string('telp',20);
          $table->string('fax',20);
          $table->string('npwp',50);
          $table->string('pkp_no',50);
          $table->longText('desc_customer');
          $table->integer('payment_term');
          $table->string('name_person',50);
          $table->string('phone_person',50);
          $table->string('email',30);
          $table->string('fax_person',30);
          $table->string('username',50);
          $table->string('password',50);
          $table->boolean('status')->default(0);
          $table->timestamp('email_verified_at')->nullable();
          $table->string('verification_code')->nullable();
          $table->integer('is_verified')->default(0);
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
        Schema::dropIfExists('customer');
    }
}
