<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CancelReservationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RefuellingController;
use App\Http\Controllers\RescheduleReservationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReturningReservationController;
use App\Http\Controllers\ScheduleReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
  ]);
});

Route::get('/dashboard', function () {
  $user = Auth::user();
  $response = Gate::inspect('accessDashboard', $user);

  if($response->denied()) return Redirect::back(302);

  return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])
  ->name('dashboard');



Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::controller(UserController::class)->group(function () {
  Route::get('/users', 'index')->name('users.index');
  Route::get('/users/{user}', 'show')->name('users.show');
});


Route::middleware('auth')->group(function () {
    Route::get('/agenda', AgendaController::class)
        ->name('agenda');
    Route::post('/agenda', ScheduleReservationController::class)
        ->name('reservation.schedule');
    Route::put('/agenda/{reservation}/reschedule', RescheduleReservationController::class)
        ->name('reservation.reschedule');
    Route::put('/agenda/{reservation}/cancel', CancelReservationController::class)
        ->name('reservation.cancel');
    Route::put('/agenda/{reservation}/returning', ReturningReservationController::class)
        ->name('reservation.returning');
});


Route::middleware('auth')->match(
    ['get', 'post'],
    'refuelling/list',
    [RefuellingController::class, 'list']
)->name('refuelling.list');
Route::middleware('auth')->resource('refuelling', RefuellingController::class)
    ->except('list');
Route::middleware('auth')->resource('vehicles', VehicleController::class);
