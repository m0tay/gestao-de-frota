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
        Schema::create('cartao_frotas', function (Blueprint $table) {
            $table->id();
            $table->enum('company', ['roboplan', 'robowork']);
            $table->string('cartao_frota');
            $table->string('pin');
            $table->enum('type', ['Combustível', 'Elétrico']);
            $table->date('expiration_date');
            $table->foreignId('vehicle_id')->constrained('vehicles'); // só mostrar pela matrícula
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartao_frotas');
    }
};
