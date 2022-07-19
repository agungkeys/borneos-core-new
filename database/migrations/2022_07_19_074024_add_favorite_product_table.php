<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFavoriteProductTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('favorite')->default(0)->after('set_menu');
        });
    }
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('favorite');
        });
    }
}
