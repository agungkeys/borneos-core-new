<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddEnumTypeToPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            DB::statement("ALTER TABLE payments MODIFY COLUMN type ENUM('cash', 'transfer', 'digital','voucher') NOT NULL");
        });
    }
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            //
        });
    }
}
