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
        Schema::create('tire_sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->string('tire_booklet')->nullable();
            $table->string('tire_1st_axle_brand')->nullable();
            $table->string('tire_1st_axle_model')->nullable();
            $table->string('tire_2nd_axle_brand')->nullable();
            $table->string('tire_2nd_axle_model')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tire_sets');
    }
};
