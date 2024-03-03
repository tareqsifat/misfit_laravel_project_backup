<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchAccountLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_account_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id')->nullable();
            $table->bigInteger('account_category_id')->nullable();
            $table->bigInteger('account_id')->nullable();
            $table->double('amount')->nullable();
            $table->string('type',45)->nullable();
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->tinyInteger('is_income',)->default('0');
            $table->tinyInteger('is_expense',)->nullable()->default('0');
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
        Schema::dropIfExists('branch_account_logs');
    }
}
