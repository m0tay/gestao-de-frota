<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleReservationRequest;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class ScheduleReservationController extends BaseAgendaController
{
    /**
     * Executes the function with the given request data to create a new reservation.
     *
     * @param ScheduleReservationRequest $request The request data needed to create the reservation
     * @return Redirect Redirects back to the previous page after creating the reservation
     */
    public function __invoke(ScheduleReservationRequest $request): RedirectResponse
    {
        $this->authorize('create', Reservation::class);

        $data = $request->validated();

        $driver = User::find($data['driver']['id']);
        $creator = User::find($data['creator']['id']);
        $vehicle = Vehicle::find($data['vehicle']['id']);

        $reservationData = [
            'title' => strtoupper($vehicle->plate) . " - " . $driver->name,
            'description' => $data['description'],
            'driver_id' => $driver->id,
            'vehicle_id' => $vehicle->id,
            'created_by' => $creator->id,
            'start' => Carbon::parse($data['start'])->format('Y-m-d H:i'),
            'end' => Carbon::parse($data['end'])->format('Y-m-d H:i'),
            'status' => 'accepted',
            'start_kms' => $vehicle->kms,
        ];

        Reservation::create($reservationData);

        return Redirect::back();
    }

}
