<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tour extends Model
{
    public function schedules()
    {
        return $this->hasMany(\App\Models\TourSchedule::class);
    }

    protected $fillable = [
        'title',
        'country',
        'start_location',
        'price',
        'days',
        'overview',
        'start_date',
        'end_date',
        'start_country',
        'end_country',
        'trip_style',
        'difficulty',
        'min_age',
        'group_size',
        'full_description'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }


    public function departures()
    {
        return $this->hasMany(\App\Models\TourDeparture::class);
    }




    protected static function booted()
    {
        static::creating(function ($tour) {
            if (!$tour->slug) {
                $tour->slug = Str::slug($tour->title);
            }
        });
    }

    public function prices()
{
    return $this->hasMany(TourPrice::class);
}

}
