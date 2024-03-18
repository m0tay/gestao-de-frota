<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturningReservationRequest;
use App\Models\Reservation;
use Illuminate\Support\Facades\Redirect;

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

        return Redirect::back();
    }
}
