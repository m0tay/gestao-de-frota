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
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->enum('company', ['roboplan', 'robowork']);
            $table->string('number_identifier');
            $table->string('contract_type');
            $table->string('contract_number');
            $table->enum('vehicle_class', [1, 2]);
            $table->enum('status', ['active', 'inactive']);
            $table->text('observation')->nullable();
            $table->timestamps();
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
