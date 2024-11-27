<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';
    protected $primaryKey = 'activity_id';

    protected $guarded = [];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
