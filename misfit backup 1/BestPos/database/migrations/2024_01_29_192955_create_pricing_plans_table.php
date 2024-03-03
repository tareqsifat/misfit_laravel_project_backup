<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->decimal('monthly_charge', 10, 2)->nullable();
            $table->decimal('yearly_charge', 10, 2)->nullable();
            $table->decimal('half_yearly_charge', 10, 2)->nullable();
            $table->decimal('flat_charge', 10, 2)->nullable();
            $table->string('flat_time')->nullable();
            $table->string('creator')->nullable();
            $table->string('slug')->nullable();
            $table->string('status')->nullable()->default(1);
            $table->timestamps();
        });

        Schema::create('plan_feature_pricing_plan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_feature_id');
            $table->unsignedBigInteger('pricing_plan_id');

            $table->foreign('plan_feature_id')->references('id')->on('plan_features')->onDelete('cascade');
            $table->foreign('pricing_plan_id')->references('id')->on('pricing_plans')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_plans');
    }
};
