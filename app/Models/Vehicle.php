<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;
use App\Models\TireSet;

class Vehicle extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'driver_id');
    }

    public function tireSet(): HasOne
    {
        return $this->hasOne(TireSet::class);
    }
}
