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
            $table->integer('company_id');
            $table->string('category_id')->comment('FK:categories.id')->nullable();
            $table->integer('brand_id')->comment('FK:brands.id')->nullable();
            $table->string('product_name');
            $table->string('pro_slug');
            $table->string('product_sku')->unique();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->integer('vat')->nullable();
            $table->string('shipping_charge_id')->nullable();
            $table->string('occasion_id')->nullable();
            $table->string('recipient_id')->nullable();
            $table->string('featured_image')->nullable();
            $table->float('regular_price', 11, 2)->nullable();
            $table->float('sales_price', 11, 2)->nullable();
            $table->float('quantity', 11, 2)->nullable();
            $table->tinyInteger('discount_status')->default(0)->comment('1=Active, 0=Inactive');
            $table->tinyInteger('status')->default(1)->comment('1=Active, 0=Inactive');
            $table->integer('product_view')->comment('How many person views the product')->default(0);
            $table->integer('occasion_visibility')->comment('Admin can stop the visibility of this product by occassion')->default(1);
            $table->integer('total_ratting')->comment('How many person rate')->nullable();
            $table->integer('average_ratting')->nullable();
            $table->string('size_guide')->nullable();
            $table->string('youtube_link')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
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
        Schema::dropIfExists('products');
    }
}
