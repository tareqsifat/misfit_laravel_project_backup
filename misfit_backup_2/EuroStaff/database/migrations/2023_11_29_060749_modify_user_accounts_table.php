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
        Schema::table('user_accounts', function(Blueprint $table){
            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();
            $table->date('date_of_birth')->nullable()->change();
            $table->enum('gender', ['Male', 'Female', 'Transgender', 'Other'])->nullable()->change();
            $table->boolean('is_active')->nullable()->change();
            $table->string('contact_number')->nullable()->change();
            $table->string('user_image')->nullable()->change();
            $table->date('registration_date')->nullable()->change();
            $table->string('name')->after('id')->nullable();
            $table->datetime('email_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_tables', function(Blueprint $table){
            $table->dropColumn('name');
            $table->unsignedTinyInteger('user_type_id')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
            $table->date('date_of_birth')->nullable(false)->change();
            $table->enum('gender', ['Male', 'Female', 'Transgender', 'Other'])->nullable(false)->change();
            $table->boolean('is_active')->nullable(false)->change();
            $table->string('contact_number')->nullable(false)->change();
            $table->string('user_image')->nullable(false)->change();
            $table->date('registration_date')->nullable(false)->change();
        });
    }
};
