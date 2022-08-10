<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBlogCategoryIdAndUserIdToBlogTable extends Migration
{
    public function up()
    {
        Schema::table('blog', function (Blueprint $table) {
            $table->integer('blog_category_id')->after('id');
            $table->integer('user_id')->after('details');
            $table->text('short_details')->after('additional_image');
            $table->dropSoftDeletes('short-details');
        });
    }
    public function down()
    {
        Schema::table('blog', function (Blueprint $table) {
            $table->dropColumn(['blog_category_id', 'user_id', 'short_details']);
        });
    }
}
