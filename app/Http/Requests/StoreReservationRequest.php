<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start' => 'required|after_or_equal:now',
            'end' => 'required|after:start',
            'driver' => 'required',
            'creator' => 'required',
            'vehicle' => 'required',
            'description' => 'required',
            'status' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'start' => 'saída',
            'end' => 'regresso',
            'driver' => 'condutor',
            'vehicle' => 'veículo',
            'description' => 'descrição',
            'reason_for_status_change' => 'pretexto para alteração do status',
        ];
    }
}
