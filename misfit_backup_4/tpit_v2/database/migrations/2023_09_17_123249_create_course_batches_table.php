<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_batches', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->nullable();
            $table->string('batch_name', 100)->nullable();
            $table->timestamp('admission_start_date')->nullable();
            $table->timestamp('admission_end_date')->nullable();
            $table->bigInteger('batch_student_limit')->nullable();
            $table->integer('seat_booked')->nullable();
            $table->integer('booked_percent')->nullable();
            $table->float('course_price')->nullable();
            $table->float('course_discount')->nullable();
            $table->float('after_discount_price')->nullable();
            $table->timestamp('first_class_date')->nullable();
            $table->string('class_days', 100)->nullable();
            $table->time('class_start_time')->nullable();
            $table->time('class_end_time')->nullable();
            
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
        Schema::dropIfExists('course_batches');
    }
}
