<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('code',100)->nullable();
            $table->string('tax',100)->nullable();
            $table->double('price')->nullable();
            $table->string('sku',100)->nullable();
            $table->integer('stock')->nullable();
            $table->double('discount_price')->nullable();
            $table->string('expiration_date',100)->nullable();
            $table->string('minimum_amount',100)->nullable();
            $table->string('free_delivarty',100)->nullable();
            $table->string('total_view',100)->nullable();
            $table->longtext('description')->nullable();
            $table->longtext('features')->nullable();
            
            $table->string('creator',100)->nullable();
            $table->string('slug',100)->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('products');
    }
}
