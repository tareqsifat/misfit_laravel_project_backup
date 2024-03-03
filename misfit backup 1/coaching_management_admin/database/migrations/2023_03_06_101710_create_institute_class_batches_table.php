<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteClassBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_class_batches', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
		    $table->bigInteger('institute_class_id',)->unsigned()->nullable();
		    $table->bigInteger('branch_id',)->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('institute_class_batch_institute_teacher', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institute_class_batch_id',)->unsigned()->nullable();
            $table->bigInteger('institute_teacher_id',)->unsigned()->nullable();
        });

        Schema::create('institute_class_batch_institute_student', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institute_class_batch_id',)->unsigned()->nullable();
            $table->bigInteger('institute_student_id',)->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institute_class_batches');
        Schema::dropIfExists('institute_class_batch_institute_teacher');
        Schema::dropIfExists('institute_class_batch_institute_student');
    }
}
