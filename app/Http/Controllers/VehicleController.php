<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\TireSet;
use App\Models\Vehicle;
use Inertia\Inertia;
use Redirect;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Vehicle::class);

        $vehicles = Vehicle::all();

        return Inertia::render('Vehicles/Index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Vehicle::class);



        return Inertia::render('Vehicles/Create', [
            'brands' => config('vehicles.brands'),
            'colors' => config('vehicles.colors'),
            'categories' => config('vehicles.categories'),
            'proprietaries' => config('vehicles.proprietaries'),
            'fuelTypes' => config('vehicles.fuel_types.assigning'),
            'driverLicenseCategories' => config('vehicles.driver_license_categories'),
            'statuses' => config('vehicles.statuses'),
            'tireBooklet' => config('vehicles.tires.booklet'),
            'tireBrands' => config('vehicles.tires.brands'),
            'tireAxles' => config('vehicles.tires.axles'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        $this->authorize('create', Vehicle::class);

        $vehicleData = $request->validated();

        $vehicle = Vehicle::create($vehicleData);

        if($vehicle->status == config('vehicles.statuses')[0]) {
            $vehicle->update(['private' => 1]);
        } else if($vehicle->status == config('vehicles.statuses')[1]) {
            $vehicle->update(['private' => 0]);
        } else {
            $vehicle->update(['active' => 0]);
        }

        $tireSetData = [
            'vehicle_id' => $vehicle->id,
            'tire_booklet' => $vehicleData['tire_booklet'],
            'tire1_brand' => $vehicleData['tire1_brand'],
            'tire1_axle' => $vehicleData['tire1_axle'],
            'tire2_brand' => $vehicleData['tire2_brand'],
            'tire2_axle' => $vehicleData['tire2_axle'],
        ];

        $vehicle->tireSet()->create($tireSetData);

        return Redirect::to(route('vehicles.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
