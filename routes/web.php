<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
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
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
  ]);
});


Route::get('/dashboard', function () {
  if (!Gate::allows('accessDashboard')) return Redirect::back();

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

Route::controller(ReservationController::class)->group(function () {
  Route::get('/reservations', 'index')->name('reservations.index');
  Route::get('/reservations/create', 'create')->name('reservations.create');
  Route::post('/reservations', 'store')->name('reservations.store');
  Route::get('/reservations/{reservation}', 'show')->name('reservations.show');
  Route::get('/reservations/{reservation}/edit', 'edit')->name('reservations.edit');
  Route::put('/reservations/{reservation}', 'update')->name('reservations.update');
  Route::delete('/reservations/{reservation}', 'destroy')->name('reservations.destroy');
})->middleware('auth');
