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
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->unsignedTinyInteger('user_type_id');
            $table->foreign('user_type_id')->references('id')->on('user_types')->onUpdate('cascade');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('date_of_birth');
            $table->enum('gender', ['Male', 'Female', 'Transgender', 'Other']);
            $table->boolean('is_active')->default(true);
            $table->string('contact_number');
            $table->string('user_image')->nullable();
            $table->date('registration_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accounts');
    }
};
