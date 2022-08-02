<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('image');
            $table->longText('additional_image')->nullable();
            $table->text('short-details');
            $table->longText('details');
            $table->integer('status');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('blog');
    }
}
