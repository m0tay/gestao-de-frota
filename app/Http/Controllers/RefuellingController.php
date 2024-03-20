<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRefuellingRequest;
use App\Http\Requests\UpdateRefuellingRequest;
use App\Models\Refuelling;
use Inertia\Inertia;

class RefuellingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Refuelling::class);

        return Inertia::render('Refuelling/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRefuellingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Refuelling $refuelling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Refuelling $refuelling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRefuellingRequest $request, Refuelling $refuelling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Refuelling $refuelling)
    {
        //
    }
}
