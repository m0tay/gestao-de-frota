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

        // Prepare title
        $driverName = User::find($data['driver']['id'])->name;
        $vehiclePlate = Vehicle::find($data['vehicle']['id'])->plate;

        $data['title'] = strtoupper($vehiclePlate) . " - " . $driverName;

        $vehicleKms = Vehicle::find($data['vehicle']['id'])->kms;

        Reservation::create([
            'title' => $data['title'],
            'rrule' => '',
            'start_kms' => $vehicleKms,
            'description' => $data['description'],
            'driver_id' => $data['driver']['id'],
            'vehicle_id' => $data['vehicle']['id'],
            'created_by' => $data['creator']['id'],
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
