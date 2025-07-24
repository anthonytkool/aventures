<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourPrice extends Model
{
    protected $fillable = [
        'tour_id',
        'pax_min',
        'pax_max',
        'price_per_person'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
