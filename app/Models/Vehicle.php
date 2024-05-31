<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;
use App\Models\FleetCard;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Retrieve the fleet card associated with this vehicle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fleetCard(): HasOne
    {
        return $this->hasOne(FleetCard::class);
    }

    /**
     * Retrieve the tire set associated with this vehicle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tireSet(): HasOne
    {
        return $this->hasOne(TireSet::class);
    }

    /**
     * Retrieve the related ViaVerde model associated with this vehicle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function viaVerde(): HasOne
    {
        return $this->hasOne(ViaVerde::class);
    }
}
