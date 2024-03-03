<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrderDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('product_order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('order_id')->nullable();
            $table->integer('qty',)->nullable();
            $table->integer('price',)->nullable();
            $table->float('discount')->nullable();
            $table->float('total')->nullable();
            $table->bigInteger('creator')->nullable();
            $table->string('slug',100)->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_order_details');
    }
}