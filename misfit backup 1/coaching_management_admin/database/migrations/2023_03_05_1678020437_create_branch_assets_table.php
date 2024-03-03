<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchAssetsTable extends Migration
{
    public function up()
    {
        Schema::create('branch_assets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id',)->nullable();
            $table->bigInteger('asset_category_id',)->nullable();
            $table->float('purchase_price')->nullable();
            $table->tinyText('name')->nullable();
            $table->float('depreciation_price')->nullable();
            $table->text('details')->nullable();
            $table->date('buying_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('branch_assets');
    }
}