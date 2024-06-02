<?php

namespace App\Http\Controllers;

use App\Models\FleetCard;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FleetCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('FleetCards/Index', [
            'fleetCards' => FleetCard::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('FleetCards/Create', [
            'fleetCards' => FleetCard::all(),
            'vehicles' => Vehicle::whereNotIn('id', FleetCard::pluck('vehicle_id'))->select('id', 'plate')->get(),
            'companies' => ['Roboplan', 'Robowork'],
            'types' => ['Combustível', 'Elétrico'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vehicle_id' => 'required',
            'company' => 'required',
            'type' => 'required',
            'pin' => 'required',
            'code' => 'required',
            'expire_at' => 'required|date',
        ]);

        $validatedData['expire_at'] = date('Y-m-d', strtotime($validatedData['expire_at']));

        $fleetCard = FleetCard::create($validatedData);
        $fleetCard->vehicle()->associate($validatedData['vehicle_id']);
        $fleetCard->save();

        return redirect()->route('fleet_cards.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(FleetCard $fleetCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FleetCard $fleetCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FleetCard $fleetCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FleetCard $fleetCard)
    {
        //
    }
}
