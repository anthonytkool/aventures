<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tour;

class Lead extends Model
{
    protected $fillable = [
        'tour_id','start_date','adults','children','hotel','pickup',
        'name','email','phone','message','status',
    ];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }
}
