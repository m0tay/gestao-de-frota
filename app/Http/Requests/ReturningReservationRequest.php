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
            'start' => ['required', 'date'],
            'returning' => [
                'required',
                'date',
                'after:start',
            ],
            'return_kms' => [
                'required',
                'numeric',
                'gt:start_kms',
            ],
        ];
    }

    public function messages()
    {
        return [
            'returning.after' => 'Não é possível entregar antes do início da requisição.',
            'return_kms' => 'Os kms  devem ser superiores ao kms inicial da requisição.',
        ];
    }
}
