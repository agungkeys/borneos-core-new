<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypePriceToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price',65,2)->default(0)->change();
            $table->decimal('tax',65,2)->default(0)->change();
            $table->decimal('discount',65,2)->default(0)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price')->default(0)->change();
            $table->decimal('tax')->default(0)->change();
            $table->decimal('discount')->default(0)->nullable()->change();
        });
    }
}
