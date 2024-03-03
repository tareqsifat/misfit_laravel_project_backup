<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFootersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            $table->string('email', 100);
            $table->string('phone', 100);
            $table->string('facebook', 100);
            $table->string('feed', 100);
            $table->string('company_name', 100);

            $table->string('creator',100)->nullable();
            $table->string('slug', 100)->nullable();
            $table->string('status', 100)->default(1);

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
        Schema::dropIfExists('footers');
    }
}
