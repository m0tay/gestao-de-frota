<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role->name, config('authorized.roles'));
    }


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, user $model): bool
    {
//        return $user->role->name === 'admin';
        return $user->id === $model->id || in_array($user->role->name, config('authorized.roles'));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
//        return $user->role->name === 'admin';
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, user $model): bool
    {
//        return $user->role->name === 'admin';
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, user $model): bool
    {
//        return $user->role->name === 'admin';
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, user $model): bool
    {
//        return $user->role->name === 'admin';
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, user $model): bool
    {
//        return $user->role->name === 'admin';
        return false;
    }
}
