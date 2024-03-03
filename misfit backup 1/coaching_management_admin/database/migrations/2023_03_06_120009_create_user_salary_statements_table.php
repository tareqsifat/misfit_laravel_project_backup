<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSalaryStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_salary_statements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id',)->unsigned()->nullable();
            $table->bigInteger('branch_id',)->unsigned()->nullable();
            $table->float('salary_amount')->nullable();
            $table->string('month', 20)->nullable();
            $table->string('salary_type', 20);
            $table->date('date')->nullable();
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
        Schema::dropIfExists('user_salary_statements');
    }
}
