<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Refuellings;
use App\Models\User;
use App\Models\Vehicle;

class RefuellingsController extends Controller
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

        $vehicles = Vehicle::select('id', 'plate', 'kms', 'company')->get();

        return Inertia::render('Refuellings/Create', compact('drivers', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
