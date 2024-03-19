<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Reservation;

class NoOverlappingReservations implements DataAwareRule, ValidationRule
{
    protected $userId;
    protected $vehicleId;
    protected $data = [];

    public function __construct($userId, $vehicleId)
    {
        $this->userId = $userId;
        $this->vehicleId = $vehicleId;
    }

    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $start = $this->data['start'];
        $end = $this->data['end'];

        $overlappingReservations = Reservation::where(function ($query) use ($start, $end) {
            $query->whereBetween('start', [$start, $end])
                ->orWhereBetween('end', [$start, $end]);
        })->where(function ($query) {
            $query->where('driver_id', $this->userId)
                ->orWhere('vehicle_id', $this->vehicleId);
        })->where('status', 'accepted')
        ->exists();

        if ($overlappingReservations) {
            $fail('A data e hora introduzidas sobrepõem-se a uma requisição existente. Verifique a agenda.');
        }
    }

}
