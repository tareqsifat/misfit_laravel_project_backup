<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id',)->nullable();
            $table->tinyInteger('is_cash')->default(0);
            $table->string('title',45)->nullable();
            $table->text('description')->nullable();
            $table->integer('total_income')->nullable();
            $table->integer('total_expense')->nullable();
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
        Schema::dropIfExists('branch_accounts');
    }
}
