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
        

        Schema::create('geolocations', function (Blueprint $table) {
            $table->id();
        $table->double('accuracy');
        $table->double('latitude');
        $table->double('longitude');
        $table->unsignedBigInteger('employee_id'); // Add the employee_id column
        $table->timestamps();

        $table->foreign('employee_id')->references('employee_id')->on('borrows')->onDelete('cascade');

      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geolocations');
    }
};
