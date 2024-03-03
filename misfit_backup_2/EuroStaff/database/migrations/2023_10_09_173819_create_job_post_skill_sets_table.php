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
        Schema::create('job_post_skill_sets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_set_id');
            $table->foreign('skill_set_id')->references('id')->on('skill_sets')->onUpdate('cascade');
            $table->unsignedBigInteger('job_post_id');
            $table->foreign('job_post_id')->references('id')->on('job_posts')->onUpdate('cascade');
            $table->integer('skill_level')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_post_skill_sets');
    }
};
