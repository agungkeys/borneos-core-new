<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('logo');
            $table->text('logo_additional');
            $table->text('address');
            $table->text('address_lat');
            $table->text('address_lng');
            $table->integer('phone');
            $table->string('email');
            $table->text('footer_text');
            $table->text('seo_title');
            $table->text('seo_description');
            $table->text('seo_author');
            $table->text('seo_keywords');
            $table->text('seo_image');
            $table->text('seo_image_additional');
            $table->text('seo_twitter_link');
            $table->text('seo_facebook_link');
            $table->boolean('maintenance_mode')->default(0);
            $table->integer('min_delivery_charge');
            $table->integer('min_charge_per_km');
            $table->integer('delivery_charge_per_km');
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
        Schema::dropIfExists('generals');
    }
}
