<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
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

        return Inertia::render('Vehicles/Index');
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

        $data = $request->validated();

        dd($data);

        $vehicle = Vehicle::create($data);

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
