<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appoint_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title_image',100);
            $table->string('form_image',100);
            $table->text('title_message');
            $table->text('question_message');
            $table->boolean('published')->default(1);
            $table->string('creator',100)->nullable();
            $table->string('slug',100)->nullable();
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
        Schema::dropIfExists('appoint_pages');
    }
}
