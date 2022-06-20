<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned()->nullable();
            $table->text('category_ids')->nullable();
            $table->text('categories_id')->nullable();
            $table->text('categories_ids')->nullable();
            $table->string('merchant_type')->nullable();
            $table->string('name');
            $table->string('slug',255);
            $table->string('phone',20)->unique();
            $table->string('email',100)->nullable();
            $table->longtext('logo')->nullable();
            $table->longtext('additional_image')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('district',100)->nullable();
            $table->text('address')->nullable();
            $table->text('footer_text')->nullable();
            $table->decimal('minimum_order', $precision = 6, $scale = 2)->default(0);
            $table->decimal('comission', $precision = 6, $scale = 2)->default(0);
            $table->tinyInteger('schedule_order')->default(0);
            $table->time('opening_time')->nullable();
            $table->time('closeing_time')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('vendor_id')->length(2)->unsigned()->nullable();
            $table->tinyInteger('free_delivery')->default(0);
            $table->string('rating', 255)->nullable();
            $table->string('cover_photo', 255)->nullable();
            $table->tinyInteger('delivery')->default(1);
            $table->string('delivery_time', 100)->nullable();
            $table->tinyInteger('take_away')->default(1);
            $table->tinyInteger('food_section')->default(1);
            $table->decimal('tax', $precision = 6, $scale = 2)->default(0);
            $table->tinyInteger('review_section')->default(1);
            $table->boolean('active')->default(1);
            $table->string('off_day', 255)->nullable();
            $table->string('gst', 255)->nullable();
            $table->tinyInteger('self_delivery_system')->default(0);
            $table->tinyInteger('pos_system')->default(0);
            $table->boolean('cash_on_delivery')->default(0);
            $table->string('seo_image',255);
            $table->longText('additional_seo_image');
            $table->tinyInteger('merchant_favorite')->default(0);
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
        Schema::dropIfExists('merchants');
    }
}
