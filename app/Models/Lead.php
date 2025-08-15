<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tour;

class Lead extends Model
{
    protected $fillable = [
    'tour_id',
    'first_name',
    'last_name',
    'nationality',
    'age',
    'email',
    'phone',
    'start_date',
    'adults',
    'children',
    'message',
    'status',
    'hotel',
    'pickup',
];


    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }
}
