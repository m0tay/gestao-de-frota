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
            'brand' => ['required', 'string', 'in:' . implode(',', array_keys(config('vehicles.brands')))],
            'model' => ['required', 'string'],
            'group' => ['required', 'string'],
            'category' => ['required', 'string', 'in:' . implode(',', array_keys(config('vehicles.categories')))],
            'proprietary' => ['required', 'string', 'in:' . implode(',', array_keys(config('vehicles.proprietaries')))],
            'status' => ['required', 'string', 'in:active'],
            'kms' => ['required', 'integer'],
            'fuel_type' => ['required', 'string', 'in:' . implode(',', array_keys(config('vehicles.fuel_types.assigning')))],
        ];
    }
}

