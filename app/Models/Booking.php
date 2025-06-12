<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'tour_departure_id',
        'user_id',
        'name',
        'email',
        'phone',
        'nationality',
        'num_people',
        'adults',
        'children',
        'special_request',
        'total_price',
        'status',
    ];

    // ความสัมพันธ์กับทัวร์
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    // ความสัมพันธ์กับวันเดินทาง
    public function departure()
    {
        return $this->belongsTo(TourDeparture::class, 'tour_departure_id');
    }
}
