<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ReservationController extends Controller
{
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

    $drivers = User::query(function ($query) {
      return $query->select('id', 'name');
    })->get();

    $vehicles = Vehicle::query(function ($query) {
      return $query->select('id', 'plate');
    })->get();


    return Inertia::render('Reservations/Index', compact('reservations', 'drivers', 'vehicles'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreReservationRequest $request)
  {
    $this->authorize('create', Reservation::class);

    $data = $request->validated();

    $driverName = User::find($data['driver'])->name;
    $vehiclePlate = Vehicle::find($data['vehicle'])->plate;

    $data['title'] = strtoupper($vehiclePlate) . " - " . $driverName;

//    dd($data);

    Reservation::create([
      'title' => $data['title'],
      'description' => $data['description'] ?? 'no desc',
      'driver_id' => $data['driver'],
      'vehicle_id' => $data['vehicle'],
      'created_by' => $data['creator'],
      'start' => Carbon::parse($data['start'])->format('Y-m-d H:i'),
      'end' => Carbon::parse($data['end'])->format('Y-m-d H:i'),
    ]);

    return back();
  }


  /**
   * Show a specific reservation
   */
  public function show(Reservation $reservation)
  {
    //
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

    Log::info($data);

    // Prepare data for the new reservation
    $newReservationData = [
      'title' => $data['title'],
      'description' => fake()->sentence(),
      'driver_id' => $data['driver']['id'], // Use the ID directly
      'vehicle_id' => $data['vehicle']['id'], // Use the ID directly
      'created_by' => $data['creator']['id'],
      'start' => Carbon::parse($data['start'])->format('Y-m-d H:i'),
      'end' => Carbon::parse($data['end'])->format('Y-m-d H:i'),
      'previous_reservation' => $data['id'],

    ];


    // Create a new reservation with the prepared data
    Reservation::insert($newReservationData);

    $reservation->update(['status' => 'denied']);

    return back();
  }



  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Reservation $reservation)
  {
    //
  }
}
