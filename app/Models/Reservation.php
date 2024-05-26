<?php

namespace App\Models;

use App\Http\Controllers\ReservationController;
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
        'description',
        'reason_for_status_change',
        'previous_reservation',
        'status',
        'start_kms',
        'returned_at',
        'returned_kms',
        'returned_ok',
        'returned_condition',
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

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
