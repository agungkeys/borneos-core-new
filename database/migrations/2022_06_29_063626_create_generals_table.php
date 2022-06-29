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
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('logo')->nullable();
            $table->text('logo_additional')->nullable();
            $table->text('address')->nullable();
            $table->text('address_lat')->nullable();
            $table->text('address_lng')->nullable();
            $table->integer('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('footer_text')->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_author')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('seo_image')->nullable();
            $table->text('seo_image_additional')->nullable();
            $table->text('seo_twitter_link')->nullable();
            $table->text('seo_facebook_link')->nullable();
            $table->boolean('maintenance_mode')->default(0);
            $table->integer('min_delivery_charge')->nullable();
            $table->integer('min_charge_per_km')->nullable();
            $table->integer('delivery_charge_per_km')->nullable();
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
