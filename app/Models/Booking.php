<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{

    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'user_id',
        'room_id',
        'pool_id',
        'activity_id',
        'hall_id',
        'down_payment',
        'payment_method',
        'check_in',
        'check_out',
        'payment_status',
        'booking_status',
        'note',
        'balance_due',
        'total_amount',
        'decline_reason',
        'cateringservice_fee',
        'soundsystem_fee',
        'additional_hours',
        'extra_bed_qty',
        'extra_bed_totalfee',
        'number_of_person',
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];
    // Define the user relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    public function pool(): BelongsTo
    {
        return $this->belongsTo(Pool::class, 'pool_id', 'pool_id');
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'activity_id', 'activity_id');
    }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class, 'hall_id', 'hall_id');
    }
}
