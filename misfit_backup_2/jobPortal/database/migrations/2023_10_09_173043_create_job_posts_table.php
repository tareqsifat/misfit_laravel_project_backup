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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('posted_by_id')->nullable();
            $table->foreign('posted_by_id')->references('id')->on('user_accounts')->nullable();
            $table->unsignedBigInteger('job_type_id')->nullable();
            $table->foreign('job_type_id')->references('id')->on('job_types')->onUpdate('cascade')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->nullable();
            // $table->boolean('is_company_name_hidden')->default(0);
            $table->date('created_date')->default(now());
            $table->date('deadline')->nullable();
            $table->string('job_title')->nullable();
            $table->integer('vacancy')->nullable();
            $table->string('job_slug')->nullable();
            $table->string('job_salary')->nullable();
            $table->string('job_location')->nullable();
            $table->text('job_description')->nullable();
            $table->boolean('is_active')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
