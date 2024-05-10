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
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('driver_id')->constrained('users')->nullable();
            $table->string('infraction');
            $table->unsignedDecimal('fine', 10, 2);
            $table->date('payment_date');

            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('address_city');
            $table->string('address_state');

            $table->timestamp('infraction_date');

            $table->text('observation')->nullable();

            $table->string('fine_type_1');
            $table->date('fine_date_1');

            $table->string('fine_type_2')->nullable();
            $table->date('fine_date_2')->nullable();

            $table->string('fine_type_3')->nullable();
            $table->date('fine_date_3')->nullable();

            $table->string('fine_type_4')->nullable();
            $table->date('fine_date_4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
