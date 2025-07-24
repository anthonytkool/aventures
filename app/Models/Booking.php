<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TourDeparture;

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
        'adults',
        'children',
        'num_people',
        'special_request',
        'total_price',
        'status',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function departure()
    {
        return $this->belongsTo(TourDeparture::class, 'tour_departure_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
