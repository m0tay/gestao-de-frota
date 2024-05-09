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
        Schema::create('revisions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('driver_id')->constrained('users');

            $table->date('last_revision_date')->nullable();
            $table->bigInteger('last_revision_kms')->nullable();
            $table->date('next_revision_date')->nullable();
            $table->bigInteger('next_revision_kms')->nullable();

            $table->date('entered_workshop_date')->nullable();
            $table->date('left_workshop_date')->nullable();
            $table->date('warranty_expiration_date')->nullable();

            $table->string('workshop_name')->nullable();
            $table->string('workshop_address_1')->nullable();
            $table->string('workshop_address_2')->nullable();
            $table->string('workshop_address_city')->nullable();
            $table->string('workshop_address_state')->nullable();
            $table->string('workshop_address_code')->nullable();
            $table->string('workshop_phone_number')->nullable();
            $table->boolean('at_workshop')->default(false);

            $table->text('maintenance_description')->nullable();
            $table->unsignedDecimal('maintenance_cost', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revisions');
    }
};
