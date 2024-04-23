<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class RescheduleReservationController extends BaseAgendaController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateReservationRequest $request, Reservation $reservation)
    {
        $this->authorize('reschedule', [Reservation::class, $reservation]);

        $data = $request->validated();

        $driver = User::find($data['driver']['id']);
        $creator = User::find($data['creator']['id']);
        $vehicle = Vehicle::find($data['vehicle']['id']);

        Reservation::create([
            'title' => strtoupper($vehicle->plate) . " - " . $driver->name,
            'rrule' => '',
            'start_kms' => $vehicle->kms,
            'description' => $data['description'],
            'driver_id' => $driver->id,
            'vehicle_id' => $vehicle->id,
            'created_by' => $creator->id,
            'start' => Carbon::parse($data['start'])->format('Y-m-d H:i'),
            'end' => Carbon::parse($data['end'])->format('Y-m-d H:i'),
            'previous_reservation' => $data['id'],
        ]);

        $reservation->update(['status' => 'rescheduled',
            'reason_for_status_change' => $data['reason_for_status_change'],
        ]);

        return Redirect::back();
    }
}
