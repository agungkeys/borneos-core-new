<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMerchantSpecialToMerchantsTable extends Migration
{
    public function up()
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->string('merchant_special')->nullable()->after('additional_seo_image');
            $table->longText('cover_photo_mobile')->nullable()->after('merchant_special');
        });
    }
    public function down()
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->dropColumn(['merchant_special','cover_photo_mobile']);
        });
    }
}
