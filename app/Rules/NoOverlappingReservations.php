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

        $userOverlappingReservations = Reservation::where(function ($query) use ($start, $end) {
            $query->whereBetween('start', [$start, $end])
                ->orWhereBetween('end', [$start, $end])
                ->orWhere(function ($query) use ($start, $end) {
                    $query->where('start', '<=', $start)
                          ->where('end', '>=', $end);
                });
        })->where('driver_id', $this->userId)
        ->where('status', 'accepted')
        ->exists();

        $vehicleOverlappingReservations = Reservation::where(function ($query) use ($start, $end) {
            $query->whereBetween('start', [$start, $end])
                ->orWhereBetween('end', [$start, $end])
                ->orWhere(function ($query) use ($start, $end) {
                    $query->where('start', '<=', $start)
                          ->where('end', '>=', $end);
                });
        })->where('vehicle_id', $this->vehicleId)
        ->where('status', 'accepted')
        ->exists();

        if ($userOverlappingReservations) {
            $fail('Já possui uma reserva durante este período de tempo. Por favor, escolha um horário diferente.');
        }
        
        if ($vehicleOverlappingReservations) {
            $fail('Este veículo já está reservado durante este período de tempo. Por favor, escolha um veículo ou horário diferente.');
        }        
    }
}
