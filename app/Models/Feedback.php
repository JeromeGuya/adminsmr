<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'comments', 'rating'];

    // Define relationship with User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
