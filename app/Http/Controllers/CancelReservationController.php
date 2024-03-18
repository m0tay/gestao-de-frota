<?php

namespace App\Http\Controllers;

use App\Http\Requests\CancelReservationRequest;
use App\Models\Reservation;
use Illuminate\Support\Facades\Redirect;

class CancelReservationController extends BaseAgendaController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CancelReservationRequest $request, Reservation $reservation)
    {
        $this->authorize('cancel', [Reservation::class, $reservation]);

        $data = $request->validated();

//    dd($data);

        $reservation->update([
            'status' => 'denied',
            'reason_for_status_change' => $data['reason_for_status_change']]);

        return Redirect::back();
    }
}
