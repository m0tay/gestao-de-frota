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


            $table->string('plate');
            $table->string('brand');
            // Audi, BMW, Citroën, Dacia, Fiat, Ford, Honda, Hyundai, Mercedes-Benz, Mitsubishi, Nissan, Peugeot, Suzuki, Toyota, Volkswagen, Volvo
            $table->string('model');
            $table->enum('category', ['light', 'heavy']);
            //Ligeiro de Passageiros, Ligeiro de Mercadorias
            $table->string('fuel_type');
            $table->foreign('fuel_type')->references('fuel_type')->on('fuel_types');
            $table->string('chassis_number');
            $table->tinyInteger('tank_capacity');


            $table->boolean('has_adblue')->default(false);
            $table->boolean('has_leasing')->default(false);
            $table->unsignedMediumInteger('kms')->nullable();
            $table->timestamp('last_kms_update')->nullable();
            $table->string('color');
            // Branco e outros, Preto e outros, Azul e outros, Vermelho e outros, Verde e outros, Roxo e outros, Amarelo e outros, Cinza e outros, Laranja e outros, Castanho e outros, Other
            $table->string('proprietary');
            // Roboplan, EuroBic, Santander, Consumer, LeasePlan(Portugal), Roboplan / Robowork, Locarent(Portugal), Robowork, Não pertence à frota/Foi Vendido
            $table->enum('company', ['roboplan', 'robowork']);
            $table->enum('group', ['private', 'public']);
            $table->enum('status', ['active', 'inactive'])->default('active');


            $table->date('leasing_start_date')->nullable();
            $table->date('leasing_end_date')->nullable();
            $table->unsignedInteger('leasing_contracted_kms')->nullable();
            $table->unsignedDecimal('leasing_monthly_payment', 10, 2)->nullable();
            $table->date('leasing_deadline_in_months');
            $table->unsignedDecimal('leasing_expected_kms', 10, 2);
            $table->unsignedDecimal('leasing_now_kms', 10, 2);
            $table->unsignedDecimal('leasing_detour_kms', 10, 2);


            $table->date('plate_date')->nullable();
            $table->foreignId('cartao_frota')->nullable()->constrained('cartao_frotas');


            $table->json('tires_ref');
            $table->string('tires_1st_axis_brand');
            $table->string('tires_1st_axis_type');

            $table->string('tires_2nd_axis_brand');
            $table->string('tires_2nd_axis_type');


            $table->foreignId('policy_id')->nullable()->constrained('insurances');
            $table->foreignId('cargo_policy_id')->nullable()->after('has_cargo_insurance')->constrained('insurances');
            $table->boolean('has_cargo_insurance')->default(false);

            $table->foreignId('next_ipo_id')->constrained('ipos');
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
