<?php

namespace App\Http\Controllers;

use App\Http\Requests\CancelReservationRequest;
use App\Http\Requests\ReturningReservationRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ReservationController extends Controller
{
    protected array $authorized = [
        'admin',
        'manager'
    ];

    /**
     * Displays a list of reservations.
     *
     * @return \Inertia\Response  Renders the Inertia 'Reservations/Index' view with reservations data.
     */
    public function index()
    {
//    Auth::loginUsingId(3); // Temporary login for development

        $this->authorize('viewAny', Reservation::class); // Enforce authorization policy

        $reservations = Reservation::with('driver', 'vehicle', 'creator')->get(); // Fetch reservations with eager loading

        $previousReservations = Reservation::where('status', 'rescheduled')->with('creator', 'driver', 'vehicle')->get();

        // Check for past due reservations and apply `done` to them if not already denied
        foreach ($reservations as $reservation) {
            if (Reservation::where('end', '<', now())
                ->whereNotIn('status', ['rescheduled', 'denied'])
                ->update(['status' => 'done'])
            ) {
                $reservation->update(['status' => 'done']);
            }
        }

        $drivers = null;

        // Only sending one driver for the unauthorized user, and multiple for authorized ones
        if (!in_array(Auth::user()->role->name, $this->authorized)) {
            $drivers = User::find(Auth::user());
        } else {
            $drivers = User::query(function ($query) {
                return $query->select('id', 'name');
            })->get();
        }

        $vehicles = Vehicle::where('group', 'public')->getQuery(function ($query) {
            return $query->select('id', 'plate');
        })->get();


        return Inertia::render('Reservations/Index', compact('reservations', 'previousReservations', 'drivers', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
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
            'driver_id' => $data['driver']['id'], // Use the ID directly
            'vehicle_id' => $data['vehicle']['id'], // Use the ID directly
            'created_by' => $data['creator']['id'],
            'start' => Carbon::parse($data['start'])->format('Y-m-d H:i'),
            'end' => Carbon::parse($data['end'])->format('Y-m-d H:i'),
            'status' => 'accepted',
        ]);

        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show a specific reservation
     */
    public function show(Reservation $reservation)
    {

        $this->authorize('view', Reservation::class);

//    dd(Reservation::find($reservation));

        return Reservation::find($reservation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
//    $reservation->load('driver', 'vehicle', 'creator'); // Load related models
//
//    $reservationResource = new ReservationResource($reservation); // Create a Laravel resource
//
//    return Inertia::render('Reservations/Edit', [
//      'reservation' => $reservationResource->toArray(request())
//    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }

    public function cancel(CancelReservationRequest $request, Reservation $reservation)
    {
        $this->authorize('cancel', [Reservation::class, $reservation]);

        $data = $request->validated();

//    dd($data);

        $reservation->update([
            'status' => 'denied',
            'reason_for_status_change' => $data['reason_for_status_change']]);

        return back();
    }

    public function returning(ReturningReservationRequest $request, Reservation $reservation)
    {
        $this->authorize('returning', [Reservation::class, $reservation]);

        $data = $request->validated();

        $reservation->update([
            'status' => 'done',
        ]);

//        dd($data);

        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $this->authorize('update', [Reservation::class, $reservation]);

        $data = $request->validated();


        // Prepare title
        $driverName = User::find($data['driver']['id'])->name;
        $vehiclePlate = Vehicle::find($data['vehicle']['id'])->plate;

        $data['title'] = strtoupper($vehiclePlate) . " - " . $driverName;

//    dd($data);

        // Prepare data for the new reservation
        $newReservationData = [
            'title' => $data['title'],
            'rrule' => '',
            'description' => $data['description'],
            'driver_id' => $data['driver']['id'], // Use the ID directly
            'vehicle_id' => $data['vehicle']['id'], // Use the ID directly
            'created_by' => $data['creator']['id'],
            'start' => Carbon::parse($data['start'])->format('Y-m-d H:i'),
            'end' => Carbon::parse($data['end'])->format('Y-m-d H:i'),
            'previous_reservation' => $data['id'],
        ];

//    dd($newReservationData['id'], $reservation->id);

        // Create a new reservation with the prepared data
        $newReservation = Reservation::create($newReservationData);

//    ]);

        $reservation->update(['status' => 'rescheduled',
            'reason_for_status_change' => $data['reason_for_status_change'],
        ]);

        return back();
    }
}
