<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_ledgers', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('invoice_no');
            $table->date('invoice_date');
            $table->integer('product_id');
            $table->integer('variation_id')->nullable();
            $table->integer('stock_in')->comment('Product Qty')->nullable();
            $table->integer('stock_out')->comment('Product Qty')->nullable();
            $table->tinyInteger('ledger_type')->comment('1=Stock Transfer, 2=Sales Invoice, 3=Sales Return, 4=Beginning Stock');
            $table->tinyInteger('status')->comment('0=Inactive, 1=Active');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
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
        Schema::dropIfExists('stock_ledgers');
    }
}
