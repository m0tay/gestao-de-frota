<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Vehicle;
use App\Models\User;

class Refuellings extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'liters',
        'price',
        'refuel_date',
        'description',
        'fuel_type',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'driver_id');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
