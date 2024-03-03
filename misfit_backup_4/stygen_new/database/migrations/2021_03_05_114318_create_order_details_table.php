<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->integer('order_id');
            $table->string('product_id');
            $table->bigInteger('price');
            $table->bigInteger('quantity');
            $table->bigInteger('total_amount');
            $table->string('transaction_id');
            $table->string('status')->default('Pending')->comment('1=Pending, 2=Accepted by Seller, 3=Shipped to Homekitchen by Seller, 4=Canceled by Seller, 5=In Transit by Admin, 6=Returned by Admin, 7=Return to Seller');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
