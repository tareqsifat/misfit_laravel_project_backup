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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('employer_id')->default(1)->nullable();
            $table->text('description')->nullable();      
            $table->string('image', 200)->nullable();
            $table->string('location', 100)->nullable();
            $table->string('team_size', 50)->nullable();
            $table->date('establishment_date')->nullable();
            $table->text('company_website_url')->nullable();
            $table->integer('status')->default(1);
            $table->integer('is_top')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
