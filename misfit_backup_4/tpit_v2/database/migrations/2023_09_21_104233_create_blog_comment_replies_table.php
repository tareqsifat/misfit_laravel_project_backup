<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCommentRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_comment_replies', function (Blueprint $table) {
            $table->id();
            $table->text('comment')->nullable();

            $table->bigInteger("creator")->unsigned()->nullable();
            $table->string("slug", 50)->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
        });

        Schema::create('blog_comment_blog_comment_repliy', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('blog_comment_id')->nullable();
            $table->bigInteger('blog_comment_repliy_id')->nullable();
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
        Schema::dropIfExists('blog_comment_replies');
        Schema::dropIfExists('blog_comment_blog_comment_repliy');

    }
}
