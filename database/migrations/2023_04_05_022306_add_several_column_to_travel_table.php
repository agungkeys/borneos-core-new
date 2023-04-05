<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeveralColumnToTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travels', function (Blueprint $table) {
            //
            $table->boolean('ktp')->after('url_idvaccine')->default(false);
            $table->boolean('kk')->after('ktp')->default(false);
            $table->boolean('vaccine')->after('kk')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travels', function (Blueprint $table) {
            //
            $table->dropColumn('ktp');
            $table->dropColumn('kk');
            $table->dropColumn('vaccine');
        });
    }
}
