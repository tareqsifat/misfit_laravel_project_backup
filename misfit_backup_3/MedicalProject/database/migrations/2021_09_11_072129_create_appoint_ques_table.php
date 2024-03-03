<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointQuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appoint_ques', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->longtext('answer');
            $table->string('creator',100)->nullable();
            $table->string('slug',100)->nullable();
            $table->boolean('status',100)->default(1);
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
        Schema::dropIfExists('appoint_ques');
    }
}
