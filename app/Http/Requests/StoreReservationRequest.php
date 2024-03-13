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
        'title' => 'nullable',
        'start' => 'required|after_or_equal:now',
        'end' => 'required|after:start',
        'driver' => 'required',
        'creator' => 'required',
        'vehicle'=> 'required',
        'description' => 'required',
        'status' => 'required',
      ];
    }
}
