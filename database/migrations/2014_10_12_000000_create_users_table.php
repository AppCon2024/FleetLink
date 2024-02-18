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
            $table->string('role');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('employee_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('department');
            $table->string('position');
            $table->string('password');
            $table->string('photo', 255);
            $table->string('last_seen')->nullable();
            $table->string('status')->default('offline');
            $table->string('region_text')->nullable();
            $table->string('province_text')->nullable();
            $table->string('city_text')->nullable();
            $table->string('barangay_text')->nullable();
            $table->string('street')->nullable();
            $table->string('zip_code')->nullable();
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
