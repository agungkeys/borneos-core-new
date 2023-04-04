<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->id();
            $table->string('prefix');
            $table->string('fullname');
            $table->string('telp');
            $table->longText('full_address');
            $table->string('sub_district');
            $table->string('district');
            $table->string('route');
            $table->string('seat_no')->nullable();
            $table->string('url_idcard');
            $table->string('url_idvaccine');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travels');
    }
}
