<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id',)->unsigned()->nullable();
            $table->date('admission_date')->nullable();
            $table->bigInteger('creator',)->unsigned()->nullable();
            $table->string('slug',50)->nullable();
            $table->tinyInteger('status',)->nullable()->default('1');
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
        Schema::dropIfExists('institute_students');
    }
}
