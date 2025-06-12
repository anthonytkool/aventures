<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TourDeparture extends Model
{
    protected $fillable = [
    'tour_id',
    'start_date',
    'end_date',
    'price',          
    'capacity',
];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
