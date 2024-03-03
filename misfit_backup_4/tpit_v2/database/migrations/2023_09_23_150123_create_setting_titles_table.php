<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_titles', function (Blueprint $table) {
            $table->id();
            $table->string('title',100)->nullable();
            $table->string('group',100)->nullable();
            
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
        Schema::dropIfExists('setting_titles');
    }
}
