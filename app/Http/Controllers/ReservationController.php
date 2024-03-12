<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
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

    return Inertia::render('Reservations/Index', compact('reservations'));
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
    //
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

    $reservation->update(['status' => 'denied']);

    // todo: create new reservation from here


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
