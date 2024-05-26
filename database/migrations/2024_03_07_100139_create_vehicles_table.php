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
            $table->string('plate');
            $table->string('brand');
            $table->string('model');
            $table->string('color');
            $table->string('proprietary');
            $table->unsignedMediumInteger('kms')->nullable();
            $table->boolean('returned_ok')->default(true);
            $table->text('returned_condition')->nullable();
            $table->string('group');
            $table->string('category');
            $table->boolean('is_active')->default(true);
            $table->string('fuel_type');
            $table->timestamps();
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
