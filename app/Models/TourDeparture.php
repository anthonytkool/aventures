<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TourDeparture extends Model
{
    protected $fillable = ['tour_id','start_date','end_date','available_seats'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
