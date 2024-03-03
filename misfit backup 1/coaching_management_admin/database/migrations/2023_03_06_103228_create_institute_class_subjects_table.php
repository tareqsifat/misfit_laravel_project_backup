<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteClassSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_class_subjects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id')->nullable();
            $table->bigInteger('subject_id')->nullable();
            $table->string('title',100)->nullable();
            $table->timestamps();
        });

        Schema::create('institute_class_institute_class_subject', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institute_class_id')->unsigned();
            $table->bigInteger('institute_class_subject_id')->unsigned();
        });

        Schema::create('institute_class_batch_institute_class_subject', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institute_class_batch_id')->unsigned();
            $table->bigInteger('institute_class_subject_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institute_class_subjects');
        Schema::dropIfExists('institute_class_institute_class_subject');
        Schema::dropIfExists('institute_class_batch_institute_class_subject');
    }
}
