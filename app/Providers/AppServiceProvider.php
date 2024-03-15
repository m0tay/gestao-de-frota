<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Access\Response;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Gate::define('accessDashboard', function (User $user) {
//      Log::info('Gate accessDashboard called for user: ' . $user->role->name);
      //      Log::info('User can access dashboard: ' . ($result ? 'Yes' : 'No'));
      return $user->canAccessDashboard();
    });

  }
}
