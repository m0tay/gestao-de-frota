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
            $table->timestamps();
            $table->foreignId('vehicle_id')->constrained('vehicles');

            $table->string('tire_booklet');
            $table->string('tire1_brand');
            $table->string('tire1_axle');
            $table->string('tire2_brand');
            $table->string('tire2_axle');
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
