<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->string('product_name');
            $table->bigInteger('product_price');
            $table->bigInteger('product_discount');
            $table->string('product_discount_type');
            $table->string('product_image');
            $table->longText('product_image_additional')->nullable();
            $table->bigInteger('product_qty');
            $table->bigInteger('product_total_price');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
