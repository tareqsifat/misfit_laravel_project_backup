<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('brand_name');
            $table->string('brand_slug');
            $table->text('brand_website')->nullable();
            $table->text('brand_description')->nullable();
            $table->string('brand_image')->nullable();
            $table->tinyInteger('approve')->default(0)->comment('1=Approve, 0=Not Approve');
            $table->tinyInteger('status')->default(1)->comment('1=Active, 0=Inactive');
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
        Schema::dropIfExists('brands');
    }
}
