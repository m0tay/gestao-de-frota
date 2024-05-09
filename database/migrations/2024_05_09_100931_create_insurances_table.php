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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Informação Geral
            $table->string('insurance_company'); // companhia de seguros
            /*
            AGEAS
            Fidelidade
            Tranquilidade
            Victoria
            Allianz
            Zurich
            */
            // logo da seguradora
            $table->enum('company', ['roboplan', 'robowork']); // nome do cliente
            $table->string('mediator_name');
            $table->date('start');
            $table->date('end');
            $table->string('policy_number'); // apólice
            $table->unsignedDecimal('anual_price', 10, 2);
            $table->unsignedDecimal('own_damage_prize', 10, 2); // prémio danos próprios
            $table->unsignedDecimal('bonus', 10, 2); // valor do bónus
            $table->text('observation')->nullable();
            $table->boolean('canceled_policy')->default(false);
            $table->foreignId('vehicle_id')->constrained('vehicles'); //  matricula

            $table->string('client_address');
            /* 
            Rua da Paz 292, Cacia Aveiro 3800-587 Portugal
            Rua da Paz 292, Cacia Aveiro 3800-587 Portugal
            */

            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('address_city');
            $table->string('address_state');
            $table->string('address_country');
            $table->string('address_code');


            // Informação de Cobertura

            // # Responsabilidade Civil
            $table->string('liability_for_civil_responsibility_bodily_damage'); // Responsabilidade_Civil_Danos_Corporais
            $table->string('liability_for_civil_responsibility_material_damage'); // Responsabilidade_Civil_Danos_Materiais

            $table->string('franchise_for_civil_responsibility_bodily_damage'); 
            $table->string('franchise_for_civil_responsibility_material_damage'); 
            /* make a dropdown to either autocomplete with first options the real field or let user insert another one
            Não Aplicavel
            Condições Gerais e/ou Especiais
            Other
            */

            // # Assistência
            $table->string('legal_protection'); // proteção jurídica
            /*
            Condições Gerais e/ou Especiais
            Other (significa que você diz o que então)
            */
            $table->string('replacement_vehicle'); // usar string on linkar veículo?
            $table->string('vip_travel_assistance'); // assistência em viagem vip

            $table->string('franchise_for_legal_protection');
            $table->string('franchise_for_replacement_vehicle');
            $table->string('franchise_for_vip_travel_assistance');


            // # Proteção de Ocupantes e Condutor
            $table->string('driver_treatment_expenses');
            $table->string('occupants_treatment_expenses');
            $table->string('death_or_permanent_disability');
            $table->string('dog_and_cat_care_expenses');

            $table->string('franchise_for_driver_treatment_expenses');
            $table->string('franchise_for_occupants_treatment_expenses');
            $table->string('franchise_for_death_or_permanent_disability');
            $table->string('franchise_for_dog_and_cat_care_expenses');

            // # Danos próprios

            $table->string('break_of_glass_provider_indicated'); // quebra de vidros prestador indicado
            $table->string('theft_or_robbery'); // furto ou roubo
            $table->string('fire_or_lightning_or_explosion'); // incêndio, choques ou explosoes
            $table->string('phenomena_of_nature');
            $table->string('acts_of_vandalism');
            $table->string('shock_or_collision_or_rollover');

            $table->string('franchise_for_break_of_glass_provider_indicated');
            $table->string('franchise_for_theft_or_robbery');
            $table->string('franchise_for_fire_or_lightning_or_explosion');
            $table->string('franchise_for_phenomena_of_nature');
            $table->string('franchise_for_acts_of_vandalism');
            $table->string('franchise_for_shock_or_collision_or_rollover');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
