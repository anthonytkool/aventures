<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourPreparation extends Model
{
    protected $fillable = [
        'tour_id',
        'description',
    ];

    public $timestamps = false;

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
