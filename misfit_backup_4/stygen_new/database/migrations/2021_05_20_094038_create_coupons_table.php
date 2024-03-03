<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable();
            $table->string('title')->nullable();
            $table->string('code')->nullable();
            $table->date('start_date');
            $table->date('expire_date');
            $table->integer('use_limit')->nullable();
            $table->bigInteger('minimum_spent')->nullable()->default(0);
            $table->bigInteger('maximum_spent')->nullable()->default(0);
            $table->integer('amount')->nullable();
            $table->text('description')->nullable();
            $table->string('discount_type')->comment('Fixed, Percentage');
            $table->tinyInteger('status')->comment('0=Inactive, 1=Active');
            $table->softDeletes();
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
        Schema::dropIfExists('coupons');
    }
}
