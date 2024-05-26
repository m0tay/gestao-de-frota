<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturningReservationRequest;
use App\Models\Reservation;
use Illuminate\Support\Facades\Redirect;
use App\Models\Vehicle;
use Carbon\Carbon;

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
            'returned_kms' => $data['returned_kms'],
            'returned_at' => Carbon::parse($data['returned_at'])->format('Y-m-d H:i'),
        ]);

        $vehicle = Vehicle::find($reservation->vehicle_id)->update([
            'kms' => bcadd($data['returned_kms'], 0),
            'returned_ok' => $data['returned_ok'],
            'returned_condition' => $data['returned_condition'],
        ]);

        # todo: make change status inactive when returned not-ok

        return Redirect::back();
    }
}
