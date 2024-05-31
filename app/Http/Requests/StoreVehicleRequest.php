<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'plate' => ['required', 'string', 'regex:(^(?:[A-Z]{2}-\d{2}-\d{2})|(?:\d{2}-[A-Z]{2}-\d{2})|(?:\d{2}-\d{2}-[A-Z]{2})|(?:[A-Z]{2}-\d{2}-[A-Z]{2})$)'],
            'brand' => ['required', 'string', 'in:' . implode(',', config('vehicles.brands'))],
            'model' => ['required', 'string'],
            'color' => ['required', 'string'],
            'category' => ['required', 'string', 'in:' . implode(',', config('vehicles.categories'))],
            'proprietary' => ['required', 'string', 'in:' . implode(',', config('vehicles.proprietaries'))],
            'status' => ['required', 'string', 'in:' . implode(',', config('vehicles.statuses'))],
            'kms' => ['required', 'integer'],
            'fuel_type' => ['required', 'string', 'in:' . implode(',', config('vehicles.fuel_types.assigning'))],
            'has_adblue' => ['required', 'boolean'],
            'has_leasing' => ['required', 'boolean'],
            'chassis' => ['required', 'string'],
            'tank_capacity' => ['required', 'numeric'],
            'fleet_card' => ['required', 'string'],
            'registration_date' => ['required', 'date'],
            'tireBooklet' => ['required', 'string'],
            'tire1_brand' => ['required', 'string'],
            'tire1_axle' => ['required', 'string'],
            'tire2_brand' => ['required', 'string'],
            'tire2_axle' => ['required', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'kms' => 'quilómetros',
            'tank_capacity' => 'capacidade do tanque',
            'fleet_card' => 'cartão da frota',
            'registration_date' => 'data de registro',
            'tireBooklet' => 'livrete de ref. dos pneus',
            'tire1_brand' => 'marca',
            'tire1_axle' => 'eixo',
            'tire2_brand' => 'marca',
            'tire2_axle' => 'eixo',
            'chassis' => 'chassi',
            'fuel_type' => 'tipo de combustível',
            'plate' => 'matrícula',
            'brand' => 'marca',
            'model' => 'modelo',
            'proprietary' => 'proprietário',
            'color' => 'cor',
        ];
    }
}
