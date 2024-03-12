<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class Reservation extends Model
{
  use HasFactory;


  // Reservation Model
  protected $fillable = [
    'title',
    'start',
    'end',
    'driver_id',
    'created_by',
    'vehicle_id',
    'status',
  ];

  /**
   * @return BelongsTo
   */
  public function vehicle(): BelongsTo
  {
    return $this->belongsTo(Vehicle::class, 'vehicle_id');
  }

  /**
   * @return BelongsTo
   */
  public function driver(): BelongsTo
  {
    return $this->belongsTo(User::class, 'driver_id');
  }

  /**
   * @return BelongsTo
   */
  public function creator(): BelongsTo
  {
    return $this->belongsTo(User::class, 'created_by');
  }
}
