<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourAccommodation extends Model
{
    protected $fillable = [
        'tour_id',
        'day_number',
        'stars',
        'note' // ถ้ามี field เพิ่ม เช่น “2-star twin share” หรือ “basic guesthouse”
    ];

    public $timestamps = false;

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
