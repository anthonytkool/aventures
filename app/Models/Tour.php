<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Lead;

class Tour extends Model
{
    // ✅ keep your original allowlist
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
        'full_description',
        'duration',
        'price_note',
        // (ไม่จำเป็นต้องเพิ่ม slug/image ที่นี่ เว้นแต่คุณจะ mass-assign มัน)
    ];

    // (optional) a few handy casts if you have these columns
    protected $casts = [
        'is_popular' => 'boolean',
        'price'      => 'decimal:2',
        'base_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /** ---------- Relationships (unchanged) ---------- */
    public function schedules()
    {
        return $this->hasMany(\App\Models\TourSchedule::class);
    }

    public function images()
    {
        return $this->hasMany(\App\Models\Image::class);
    }

    public function departures()
    {
        return $this->hasMany(\App\Models\TourDeparture::class);
    }

    public function prices()
    {
        return $this->hasMany(\App\Models\TourPrice::class);
    }

    public function countries()
    {
        return $this->belongsToMany(\App\Models\Country::class);
    }

    /** ---------- Route binding by slug ---------- */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /** ---------- Scope ---------- */
    public function scopePopular($query)
    {
        return $query->where('is_popular', 1);
    }

    /** ---------- Accessors (use in Blade) ---------- */
    // <img src="{{ $tour->cover_image_url }}">
    public function getCoverImageUrlAttribute(): string
    {
        // Try a few locations, return the first that exists
        $candidates = [
            "TourCover/{$this->id}.jpg",                // legacy by ID (storage/app/public/TourCover)
            $this->image ? "tourCovers/{$this->image}" : null, // explicit file name from DB
            "tourCovers/{$this->slug}.jpg",             // by slug
        ];

        foreach ($candidates as $relPath) {
            if ($relPath && Storage::disk('public')->exists($relPath)) {
                return asset('storage/' . $relPath);
            }
        }

        return 'https://via.placeholder.com/640x420?text=No+Image';
    }

    // <small>{{ $tour->duration_display }}</small>
    public function getDurationDisplayAttribute(): string
    {
        return ($this->duration && trim($this->duration) !== '1')
            ? $this->duration
            : 'Full Day Tour';
    }

    /** ---------- Unique slug on create (only if empty) ---------- */
    protected static function booted(): void
    {
        static::creating(function (self $tour) {
            if (!$tour->slug) {
                $base = Str::slug($tour->title ?? Str::random(8));
                $slug = $base;
                $i = 2;

                while (static::where('slug', $slug)->exists()) {
                    $slug = "{$base}-{$i}";
                    $i++;
                }

                $tour->slug = $slug;
            }
        });
    }
   
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

}
