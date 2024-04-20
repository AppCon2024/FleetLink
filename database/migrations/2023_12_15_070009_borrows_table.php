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
        //
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('vin');
            $table->string('plate');
            $table->string('brand');
            $table->string('model');
            $table->string('time_in');
            $table->string('time_out');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('accuracy');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('borrows');
    }
};
