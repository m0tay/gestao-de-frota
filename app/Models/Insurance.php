<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Vehicle;

class Insurance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function vehicle(): BelongsToMany
    {
        return $this->BelongsToMany(Vehicle::class);
    }
}
