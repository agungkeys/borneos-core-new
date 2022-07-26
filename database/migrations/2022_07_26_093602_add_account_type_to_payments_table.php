<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountTypeToPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('account_type')->after('type');
        });
    }
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('account_type');
        });
    }
}
