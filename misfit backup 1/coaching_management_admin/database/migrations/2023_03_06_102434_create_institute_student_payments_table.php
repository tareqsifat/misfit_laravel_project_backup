<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteStudentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_student_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id',)->nullable();
            $table->bigInteger('branch_id',)->nullable();
            $table->bigInteger('account_log_id',)->nullable();
            $table->float('amount')->nullable();
            $table->date('date')->nullable();
            $table->bigInteger('institute_student_id',)->unsigned();
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
        Schema::dropIfExists('institute_student_payments');
    }
}
