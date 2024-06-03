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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('plate')->unique();
            $table->string('brand');
            $table->string('model');
            $table->string('color');
            $table->string('proprietary');
            $table->string('chassis')->unique();
            $table->unsignedMediumInteger('kms')->nullable();
            $table->string('category');
            $table->boolean('active')->default(true);
            $table->boolean('private')->default(false);
            $table->string('fuel_type');
            $table->string('status')->default(config('vehicles.statuses')[2]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
