<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  protected $fillable = ['tour_id', 'path', 'filename'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
    
}
