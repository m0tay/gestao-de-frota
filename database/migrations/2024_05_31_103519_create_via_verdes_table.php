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
        Schema::create('via_verdes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->string('company');
            $table->string('identifier');
            $table->string('contract_type');
            $table->string('contract_number');
            $table->string('vehicle_class'); // 1, 2
            $table->boolean('active'); // active, inactive
            $table->text('observation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('via_verdes');
    }
};
