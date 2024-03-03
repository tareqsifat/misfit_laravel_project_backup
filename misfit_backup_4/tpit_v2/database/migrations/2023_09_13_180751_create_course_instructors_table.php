<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_instructors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned()->nullable();
            $table->bigInteger("course_id")->unsigned()->nullable();
            $table->string("cover_photo", 100)->nullable();
            $table->string("full_name", 100)->nullable();
            $table->string("designation", 100)->nullable();
            $table->text("details")->nullable();
            $table->bigInteger("creator")->unsigned()->nullable();
            $table->string("slug", 50)->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
        });


        Schema::create('course_course_instructor', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('instructor_id')->nullable();
            $table->bigInteger('course_id')->nullable();
            $table->bigInteger('batch_id')->nullable();
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
        Schema::dropIfExists('course_instructors');
        Schema::dropIfExists('course_course_instructor');

    }
}
