<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeminarParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminar_participants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('seminar_id')->nullable();
            $table->string('full_name', 100)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('phone_number', 40)->nullable();
            $table->string('address', 100)->nullable();
            
            $table->bigInteger("creator")->unsigned()->nullable();
            $table->string('slug',100)->nullable();
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
        Schema::dropIfExists('seminar_participants');
    }
}
