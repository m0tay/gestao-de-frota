<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
  use HasFactory;


  // Reservation Model
  public function vehicle(): BelongsTo
  {
    return $this->belongsTo(Vehicle::class);
  }

}
