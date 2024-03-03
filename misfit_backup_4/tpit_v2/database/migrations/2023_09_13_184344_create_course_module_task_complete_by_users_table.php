<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseModuleTaskCompleteByUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_module_task_complete_by_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("course_id")->unsigned()->nullable();
            $table->bigInteger("module_id")->unsigned()->nullable();
            $table->bigInteger("class_id")->unsigned()->nullable();
            $table->bigInteger("user_id")->unsigned()->nullable();

            $table->bigInteger("content_id")->unsigned()->nullable();
            $table->bigInteger("quiz_id")->unsigned()->nullable();
            $table->bigInteger("exam_id")->unsigned()->nullable();

            $table->bigInteger("creator")->unsigned()->nullable();
            $table->string("slug", 50)->nullable();
            $table->enum('status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('course_module_task_complete_by_users');
    }
}
