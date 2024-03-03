<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_teachers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id',)->unsigned()->nullable();
            $table->string('education',100)->nullable();
            $table->date('hire_date')->nullable();
            // $table->date('hire_date')->nullable();
            $table->bigInteger('creator',)->unsigned()->nullable();
            $table->string('slug',50)->nullable();
            $table->tinyInteger('status')->nullable()->default('1');
            $table->timestamps();
        });

        Schema::create('institute_branch_institute_teacher', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institute_branch_id')->unsigned()->nullable();
            $table->bigInteger('institute_teacher_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institute_teachers');
        Schema::dropIfExists('institute_branch_institute_teacher');
    }
}
