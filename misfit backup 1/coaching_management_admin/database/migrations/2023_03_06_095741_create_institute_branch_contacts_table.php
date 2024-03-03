<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteBranchContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_branch_contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('intstitue_branch_id',)->unsigned()->nullable();
            $table->string('first_name',100)->nullable();
            $table->string('last_name',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('phone_number',45)->nullable();
            $table->bigInteger('creator',)->unsigned()->nullable();
            $table->string('slug',50)->nullable();
            $table->tinyInteger('status')->nullable()->default('1');
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
        Schema::dropIfExists('institute_branch_contacts');
    }
}
