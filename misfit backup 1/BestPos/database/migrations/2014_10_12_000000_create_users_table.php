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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',100)->nullable();
            $table->string('last_name',100)->nullable();
            $table->string('user_name',100)->nullable()->unique();
            $table->string('mobile_number',100)->nullable()->unique();
            $table->string('photo')->nullable()->default('avatar.png');
            $table->string('email')->unique();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('slug',30)->nullable();

            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
