<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
<<<<<<< HEAD
use App\Models\Vehicle;
=======
>>>>>>> 0699c52163727e4e31611a0a674b0030d2ab3232

class Insurance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function vehicle(): BelongsToMany
    {
<<<<<<< HEAD
        return $this->BelongsToMany(Vehicle::class);
=======
        return $this->belongsToMany(Vehicle::class);
>>>>>>> 0699c52163727e4e31611a0a674b0030d2ab3232
    }
}
