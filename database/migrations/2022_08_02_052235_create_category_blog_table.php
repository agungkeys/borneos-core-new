<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryBlogTable extends Migration
{
    public function up()
    {
        Schema::create('category_blog', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('image');
            $table->longText('additional_image')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('category_blog');
    }
}
