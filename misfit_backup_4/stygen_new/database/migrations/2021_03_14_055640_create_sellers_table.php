<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->integer('seller_type')->comment('1=Individual, 2=Business');
            $table->string('name');
            $table->string('username');
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable()->default('default.jpg');
            $table->string('nid')->nullable();
            $table->string('tin')->nullable();
            $table->string('bin')->nullable();
            $table->tinyInteger('user_verified')->comment('1=Verified, 0=Not Verified')->nullable();
            $table->string('verified_code')->nullable();
            $table->string('OTP')->nullable();
            $table->string('gender')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Active, 0=Inactive');
            $table->rememberToken();
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
        Schema::dropIfExists('sellers');
    }
}
