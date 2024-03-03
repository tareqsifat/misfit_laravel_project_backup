<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('orderId')->nullable();
            $table->integer('shipping_id')->comment('FK:shippings.id');
            $table->integer('user_id');
            $table->integer('customer_id')->nullable();
            $table->tinyInteger('ship_to_gift')->default(0)->comment('1=Ship to Gift, 0=Not');
            $table->integer('shipping_agent_id')->nullable();
            $table->integer('invoice_last_digit')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('invoice_no_old')->nullable();
            $table->string('invoice_date');
            $table->date('delivery_date')->nullable();
            $table->tinyinteger('payment_type')->comment('1=Cash on Delivery, 2=Online Payment');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->text('notes')->nullable();
            $table->text('admin_note')->nullable();
            $table->text('personal_notes')->nullable();
            $table->integer('card_id')->nullable();
            $table->integer('card_price')->nullable();
            $table->integer('packaging_id')->nullable();
            $table->integer('packaging_price')->nullable();
            $table->bigInteger('total_amount');
            $table->string('coupon_code')->nullable();
            $table->bigInteger('coupon_amount')->nullable();
            $table->tinyinteger('discount_type')->comment('0=Amount, 1=Percentage, 2=Coupon')->nullable();
            $table->tinyinteger('ledger_type')->comment('1=Sales Invoice, 2=Sales Return, 3=Due Collection')->nullable();
            $table->float('discount_amount', 11, 2)->nullable();
            $table->integer('shipping_charge_id')->nullable();
            $table->float('shipping_charge', 11, 2)->nullable();
            $table->float('total_vat', 11, 2)->nullable();
            $table->float('net_receiveable_amount', 11, 2)->nullable();
            $table->float('collect_amount', 11, 2)->nullable();
            $table->float('return_amount', 11, 2)->nullable();
            $table->float('due_amount', 11, 2)->nullable();
            $table->string('transaction_id');
            $table->string('currency');
            $table->string('status');
            $table->string('shipping_status_id')->default('Pending')->comment('1=Pending, 2=Accepted by Seller, 3=Shipped to Homekitchen by Seller, 4=Canceled by Seller, 5=In Transit by Admin, 6=Returned by Admin, 7=Return to Seller');
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
        Schema::dropIfExists('orders');
    }
}
