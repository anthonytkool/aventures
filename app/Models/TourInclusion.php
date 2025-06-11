<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourInclusion extends Model
{
    protected $fillable = [
        'tour_id',
        'includes_insurance',
        'includes_local_guide',
        'includes_admission'
    ];

    public $timestamps = false;

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
