<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ScheduleReservationController extends BaseAgendaController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreReservationRequest $request)
    {
        $this->authorize('create', Reservation::class);

        $data = $request->validated();

        $driverName = User::find($data['driver']['id'])->name;
        $vehiclePlate = Vehicle::find($data['vehicle']['id'])->plate;

        $data['title'] = strtoupper($vehiclePlate) . " - " . $driverName;

//        dd($data);

        Reservation::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'driver_id' => $data['driver']['id'],
            'vehicle_id' => $data['vehicle']['id'],
            'created_by' => $data['creator']['id'],
            'start' => Carbon::parse($data['start'])->format('Y-m-d H:i'),
            'end' => Carbon::parse($data['end'])->format('Y-m-d H:i'),
            'status' => 'accepted',
        ]);

        return Redirect::back();
    }
}
