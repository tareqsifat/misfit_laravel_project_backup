<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('phone',100);
            $table->string('email',100)->nullable();
            $table->date('dateOfBirth');
            $table->date('appointmentDate');
            $table->text('message')->nullable();
            $table->boolean('bookedbefore')->default(0);
            $table->string('creator')->nullable();
            $table->text('slug')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('appointments');
    }
}
