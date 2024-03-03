<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteClassBatchTimeSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_class_batch_time_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day',45)->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('room', 20)->nullable();
            $table->bigInteger('branch_id')->unsigned()->nullable();
            $table->bigInteger('institute_class_id')->unsigned()->nullable();
            $table->bigInteger('institute_class_batch_id')->unsigned()->nullable();
            $table->bigInteger('institute_class_teacher_id')->unsigned()->nullable();
            $table->bigInteger('institute_class_subject_id')->nullable();
            $table->timestamps();
        });

        Schema::create('institute_class_batch_institute_class_batch_time_schedule', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institute_class_batch_id')->unsigned();
            $table->bigInteger('institute_class_batch_time_schedule_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institute_class_batch_time_schedules');
        Schema::dropIfExists('institute_class_batche_institute_class_batch_time_schedule');
    }
}
