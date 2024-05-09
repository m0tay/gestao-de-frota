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
        Schema::create('ipos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->date('date');
            $table->string('center');
            $table->foreignId('link')->constrained('ipos');
            $table->string('center_address_1');
            $table->string('center_address_2')->nullable();
            $table->string('center_address_city');
            $table->string('center_address_state');
            $table->string('center_address_zip');

            $table->text('observations')->nullable();

            $table->enum('anomaly', ['yellow', 'red']);
            $table->text('anomaly_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipos');
    }
};
