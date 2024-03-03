<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTitleValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_title_values', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('setting_title_id')->nullable();
            $table->text('setting_title')->nullable();
            $table->longText('value')->nullable();
            $table->enum('use',['yes','no'])->default('yes');

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
        Schema::dropIfExists('setting_title_values');
    }
}
