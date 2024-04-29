<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\FuelType;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'kms',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'driver_id');
    }

    public function fuelType(): BelongsTo
    {
        return $this->belongsTo(FuelType::class, 'fuel_type');
    }
}
