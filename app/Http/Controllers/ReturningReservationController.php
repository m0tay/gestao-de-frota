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

        $vehicle = Vehicle::find($reservation->vehicle_id)->update([
            'kms' => bcadd($data['return_kms'], 0),
            'return_condition' => $data['return_condition'] ? 'ok' : 'nok',
            'return_condition_description' => $data['return_condition_description'],
        ]);

        # todo: make change status inactive when returned not-ok

        return Redirect::back();
    }
}
