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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('website_name');
            $table->string('website_intro')->nullable();
            $table->text('website_description')->nullable();
            $table->string('website_email');
            $table->string('website_phone');
            $table->text('website_address');
            $table->text('about_content');
            $table->string('about_image');
            $table->string('about_yt')->nullable();
            $table->string('website_logo');
            $table->string('website_favicon');
            $table->string('facebook');
            $table->string('linkdin');
            $table->string('whatsapp');
            $table->string('youtube');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
