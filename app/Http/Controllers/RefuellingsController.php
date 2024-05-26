<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Refuellings;
use App\Models\User;
use App\Models\Vehicle;
use App\Http\Controllers\BaseAgendaController;
use Illuminate\Support\Facades\Auth;

class RefuellingsController extends BaseAgendaController
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $refuellings = Refuellings::with(['driver' => function ($query) {
            $query->select('id', 'name');
        }, 'vehicle' => function ($query) {
            $query->select('id', 'plate');
        }])->get();

        return Inertia::render('Refuellings/Index', compact('refuellings'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $drivers = User::select('id', 'name')->get();

        $vehicles = Vehicle::select('id', 'plate', 'kms', 'proprietary', 'fuel_type')->get();

        $refuellingFuelTypes = config('fueltypes.refuelling');

        $canSelectDriver = in_array(Auth::user()->role->name, $this->authorized['roles']) || in_array(Auth::user()->email, $this->authorized['emails']);

        return Inertia::render('Refuellings/Create', compact('drivers', 'vehicles', 'canSelectDriver', 'refuellingFuelTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
