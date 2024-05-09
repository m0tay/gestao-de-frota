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
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname');
            $table->string('citizen_card');
            $table->date('citizen_card_expiration_date')->nullable();
            $table->string('phone_number')->nullable();

            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('address_city');
            $table->string('address_state');
            $table->string('address_code');

            $table->string('driver_license');
            $table->date('driver_license_expiration_date')->nullable();
            $table->json('driver_license_categories'); // [A, A1, B, B1, BE, C, C1, C1E, CE, D, D1, D1E, DE]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'surname',
                'citizen_card',
                'citizen_card_expiration_date',
                'phone_number',
                'address_1',
                'address_2',
                'address_city',
                'address_state',
                'address_code',
                'driver_license',
                'driver_license_expiration_date',
                'driver_license_categories',
            ]);
        });
    }
};
