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

    // todo: change to guarded?
    protected $guarded = ['id'];

    protected $casts = [
        'tires_ref' => 'array',
    ];
    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'driver_id');
    }
}
