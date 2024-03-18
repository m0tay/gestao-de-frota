<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class ReservationPolicy
{

  protected array $authorized = [
    'admin',
    'manager'
  ];

  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(User $user): bool
  {
    return true;
  }

  /**
   * Determine whether the user can view the model.
   */
  public function view(User $user, Reservation $reservation): bool
  {
    return true;

  }

  /**
   * Determine whether the user can create models.
   */
  public function create(User $user): bool
  {
    return true;

  }

  /**
   * Determine whether the user can update the model.
   */
  public function reschedule(User $user, Reservation $reservation): bool
  {

    return in_array($user->role->name, $this->authorized);
  }

    public function returning(User $user, Reservation $reservation): bool
    {

        return in_array($user->role->name, $this->authorized) || $reservation->driver->id === $user->id;
    }

  public function cancel(User $user, Reservation $reservation): bool
  {

    return in_array($user->role->name, $this->authorized);
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, Reservation $reservation): bool
  {
    return $user->role->name === $this->authorized['admin'];
  }

  /**
   * Determine whether the user can restore the model.
   */
  public function restore(User $user, Reservation $reservation): bool
  {
    return false;
  }

  /**
   * Determine whether the user can permanently delete the model.
   */
  public function forceDelete(User $user, Reservation $reservation): bool
  {
    return false;
  }
}
