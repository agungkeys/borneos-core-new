<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('prefix');
            $table->string('order_type');
            $table->bigInteger('merchant_id');
            $table->bigInteger('courier_id')->nullable();
            $table->string('customer_name');
            $table->string('customer_telp');
            $table->text('customer_address');
            $table->string('customer_address_lat');
            $table->string('customer_address_lang');
            $table->text('customer_notes')->nullable();
            $table->string('distance');
            $table->bigInteger('total_item')->nulable();
            $table->bigInteger('total_item_price')->nullable();
            $table->bigInteger('total_distance_price')->nullable();
            $table->bigInteger('total_price')->nullable();
            $table->string('payment_type');
            $table->bigInteger('payment_total');
            $table->string('status');
            $table->text('status_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
