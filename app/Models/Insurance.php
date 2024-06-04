<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Vehicle;

class Insurance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function vehicle(): BelongsTo
    {
        return $this->BelongsTo(Vehicle::class);
    }
}
