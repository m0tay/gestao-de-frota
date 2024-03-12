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
    Auth::loginUsingId(3); // Temporary login for development

    $this->authorize('viewAny', Reservation::class); // Enforce authorization policy

    $reservations = Reservation::with('vehicle')->get(); // Fetch reservations with eager loading

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
   * Displays detailed information about a specific reservation.
   *
   * @param  \App\Models\Reservation $reservation  The reservation to be displayed
   * @return \Inertia\Response  Renders the Inertia 'Reservations/Show' view with a transformed reservation
   */
  public function show(Reservation $reservation)
  {
    $reservation->load('driver', 'vehicle', 'creator'); // Load related models

    $reservationResource = new ReservationResource($reservation); // Create a Laravel resource

    return Inertia::render('Reservations/Show', [
      'reservation' => $reservationResource->toArray(request())
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Reservation $reservation)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateReservationRequest $request, Reservation $reservation)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Reservation $reservation)
  {
    //
  }
}
