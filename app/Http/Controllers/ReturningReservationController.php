<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturningReservationRequest;
use App\Models\Reservation;
use Illuminate\Support\Facades\Redirect;
use App\Models\Vehicle;

class ReturningReservationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ReturningReservationRequest $request, Reservation $reservation)
    {
        $this->authorize('returning', [Reservation::class, $reservation]);

        $data = $request->validated();

        $reservation->update([
            'status' => 'done',
        ]);

        $vehicle = Vehicle::find($reservation->vehicle_id);

        $vehicle->update([
            'kms' => (int) $data['return_kms'],
        ]);

        # todo: make change status inactive when returned not-ok

        return Redirect::back();
    }
}

