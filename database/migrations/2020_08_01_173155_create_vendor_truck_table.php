<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorTruckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_truck', function (Blueprint $table) {
          $table->id();
          $table->string('code_vendor',10);
          $table->string('name_vendor',50);
          $table->longText('address');
          $table->string('telp',20);
          $table->integer('payment_term');
          $table->integer('trucking_type_id');
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
        Schema::dropIfExists('vendor_truck');
    }
}
