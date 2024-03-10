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
        Schema::create('combined', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('employee_id');
            $table->string('position');
            $table->string('department');
            $table->string('vin');
            $table->string('plate');
            $table->string('brand');
            $table->string('model');
            $table->string('time_in');
            $table->string('time_out');
            $table->double('latitude');
            $table->double('longitude');
            
       
            $table->timestamps();

            $table->foreign('id')->references('id')->on('borrows')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combined');
    }
};
