<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldPickUpOrderToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('pickup_name')->nullable()->after('status_notes');
            $table->bigInteger('pickup_telp')->unsigned()->nullable()->after('pickup_name');
            $table->longText('pickup_address')->nullable()->after('pickup_telp');
            $table->string('pickup_address_lat')->nullable()->after('pickup_address');
            $table->string('pickup_address_lng')->nullable()->after('pickup_address_lat');
            $table->longText('pickup_note')->nullable()->after('pickup_address_lng');
            $table->integer('cs_user_id')->unsigned()->nullable()->after('pickup_note');
            $table->string('cs_user_name')->nullable()->after('cs_user_id');
            $table->integer('crm_user_id')->unsigned()->nullable()->after('cs_user_name');
            $table->string('crm_user_name')->nullable()->after('crm_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
           $table->dropColumn(['pickup_name','pickup_telp','pickup_address','pickup_address_lat','pickup_address_lng','pickup_note','cs_user_id','cs_user_name','crm_user_id','crm_user_name']);
        });
    }
}
