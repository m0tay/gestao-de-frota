<?php

namespace App\Http\Requests;

use App\Rules\NoOverlappingReservations;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleReservationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start' => ['required', 'date', 'after_or_equal:now', new NoOverlappingReservations($this->user()->id, $this->vehicle)],
            'end' => ['required', 'date', 'after:start', new NoOverlappingReservations($this->user()->id, $this->vehicle)],
            'driver' => 'required',
            'creator' => 'required',
            'vehicle' => ['required', function ($attribute, $value, $fail) {
                if (is_null($value['id'])) {
                    $fail('Escolha um veículo.');
                }
            }],

            'description' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'start' => 'saída',
            'end' => 'retorno',
            'driver' => 'condutor',
            'vehicle' => 'veículo',
            'description' => 'descrição',
            'reason_for_status_change' => 'pretexto para alteração do status',
        ];
    }

    public function messages()
    {
        return [
            'start.required' => 'A data e hora de saída é obrigatória.',
            'start.date' => 'A data e hora de saída deve ser uma data válida.',
            'start.after_or_equal' => 'A data e hora de saída deve ser posterior ou igual à data atual.',
            'end.required' => 'A data e hora do retorno é obrigatório.',
            'end.date' => 'A data e hora de retorno deve ser uma data válida.',
            'end.after' => 'A data e hora de retorno deve ser posterior à saída.',
        ];
    }
}
