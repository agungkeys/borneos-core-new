<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalImageToBannersTable extends Migration
{
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->longText('additional_image')->nullable()->after('image');
        });
    }
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('additional_image');
        });
    }
}
