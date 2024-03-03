<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string("title", 200)->nullable();
            $table->string("image", 200)->nullable();
            $table->string("intro_video", 200)->nullable();
            $table->text("what_is_this_course")->nullable();
            $table->text("why_is_this_course")->nullable();
            $table->enum("type",['online','offline','daycare'])->nullable();

            $table->bigInteger("creator")->unsigned()->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->string("slug", 50)->nullable();
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
        Schema::dropIfExists('courses');
    }
}
