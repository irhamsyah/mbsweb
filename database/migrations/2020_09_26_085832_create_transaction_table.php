<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->string('trans_no',20);
            $table->integer('customer_id');
            $table->integer('shipping_no')->nullable();
            $table->datetime('loading_date');
            $table->integer('agent_id')->nullable();
            $table->integer('vendor_truck_id')->nullable();
            $table->integer('location_id');
            $table->integer('pelayaran_id')->nullable();
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}
