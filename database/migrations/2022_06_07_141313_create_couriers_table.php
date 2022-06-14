<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone', 13);
            $table->text('address');
            $table->string('address_lat', 100)->nullable();
            $table->string('address_lang', 100)->nullable();
            $table->string('identity_type');
            $table->string('identity_no');
            $table->date('identity_expired')->nullable();
            $table->text('identity_image')->nullable();
            $table->text('identity_additional_image')->nullable();
            $table->text('profile_image')->nullable();
            $table->text('profile_additional_image')->nullable();
            $table->string('badge')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->date('join_date')->nullable();
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
        Schema::dropIfExists('couriers');
    }
}
