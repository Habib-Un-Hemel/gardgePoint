<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $withinTransaction = false;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('address', 191);
            $table->string('phone', 191);
            $table->string('car_license', 191);
            $table->string('car_engine', 191);
            $table->foreignId('mechanic_id')->constrained();
            $table->date('appointment_date');
            $table->string('time_slot', 191);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};