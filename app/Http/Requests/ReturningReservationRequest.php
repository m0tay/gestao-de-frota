<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReturningReservationRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required',
            'start' => 'required|date',
            'returning' => [
                'required',
                'date',
                'after:start',
            ],
        ];
    }

    public function messages()
    {
        return [
            'returning.after' => 'Não é possível entregar antes do início da requisição.',
        ];
    }
}
