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
            'start_kms' => 'required|numeric',
            'start' => ['required', 'date'],
            'returned_at' => [
                'required',
                'date',
                'after:start',
            ],
            'return_kms' => [
                'required',
                'numeric',
                'gt:start_kms',
            ],
            'return_condition' => 'required',
            'return_condition_description' => 'required_if:return_condition,1',
        ];
    }

    public function messages()
    {
        return [
            'returned_at.after' => 'Não é possível entregar antes do início da requisição.',
            'return_kms.required' => 'Os kms devem ser informados.',
            'return_kms.gt' => 'Os kms  devem ser superiores ao kms inicial da requisição.',
        ];
    }
}
