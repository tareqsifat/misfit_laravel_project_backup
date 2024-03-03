<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150)->nullable();
            $table->string('image', 100)->nullable();

            $table->bigInteger("creator")->unsigned()->nullable();
            $table->string("slug", 50)->nullable();
            $table->enum('status',['active','inactive'])->default('active');

            $table->timestamps();
        });

        Schema::create('blog_blog_category', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('blog_category_id')->nullable();
            $table->bigInteger('blog_id')->nullable();

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
        Schema::dropIfExists('blogs_categories');
        Schema::dropIfExists('blog_blog_category');

    }
}
