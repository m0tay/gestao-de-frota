<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AgendaController extends BaseAgendaController
{
    public function __invoke(Request $request)
    {
        $this->authorize('viewAny', Reservation::class);

        $reservations = Reservation::with('driver', 'vehicle', 'creator')->get();

        $previousReservations = Reservation::where('status', 'rescheduled')->with('creator', 'driver', 'vehicle')->get();

        // Check for past due reservations and apply `done` to them if not already denied
        // foreach ($reservations as $reservation) {
        //     if (Reservation::where('end', '<', now())
        //         ->whereNotIn('status', ['rescheduled', 'denied'])
        //         ->update(['status' => 'done'])
        //     ) {
        //         $reservation->update(['status' => 'done']);
        //     }
        // }

        $drivers = null;

        // Only sending one driver for the unauthorized user, and multiple for authorized ones
        $canSelectDriver = in_array(Auth::user()->role->name, $this->authorized['roles']) || in_array(Auth::user()->email, $this->authorized['emails']);
        if (!$canSelectDriver) {
            $drivers = User::find(Auth::user());
        } else {
            $drivers = User::select('id', 'name')->get();
        }

        $vehicles = Vehicle::select('id', 'plate')->where('active', 1)->where('private', 0)->get();

        return Inertia::render('Reservations/Index', compact('reservations', 'previousReservations', 'drivers', 'vehicles', 'canSelectDriver'));
    }
}
