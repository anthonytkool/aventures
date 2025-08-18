<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    // แสดงรายการทัวร์ทั้งหมด
    public function index(Request $request)
    {
        $query = Tour::query();

        $raw = (string) $request->query('country', '');
        $country = trim($raw);

        if ($country !== '') {
            $isSeries = preg_match('/cross[\-\s]?border/i', $country)
                || strcasecmp($country, 'series') === 0
                || strcasecmp($country, 'Cross-Border Trips Series') === 0;

            if ($isSeries) {
                $query->where(function ($q) {
                    $q->whereNotNull('series')
                        ->orWhere('category', 'series')
                        ->orWhere('country', 'like', '%,%');
                });
            } else {
                $like = "%{$country}%";
                $query->where(function ($q) use ($like, $country) {
                    $q->where('country', 'like', $like)
                        ->orWhereHas('countries', function ($cq) use ($country) {
                            $cq->where('name', $country);
                        });
                });
            }
        }

        $tours = $query->orderByDesc('created_at')->paginate(12);

        return view('tours.index', compact('tours', 'country'));
    }

    // แสดงรายละเอียดทัวร์
    // แสดงรายละเอียดทัวร์
public function show($slug)
{
    $tour = \App\Models\Tour::with(['departures', 'images'])
        ->where('slug', $slug)
        ->firstOrFail();

    // Mapping Quick Info ตาม slug
    $map = [

        // Bangkok Royal / Grand Palace (ใส่ทุกฟิลด์ไว้ "ภายใน" อาร์เรย์นี้เท่านั้น)
        'bangkok-grand-palace-temple-tour' => [
            'duration'   => 'Full Day (≈ 7–8 hrs)',
            'start_end'  => 'Start/Finish: Bangkok',
            'start_time' => '08:00',
            'pickup'     => 'Central Bangkok pickup included',
            'group'      => 'Private tour only (min 2 pax)',   // จุดที่ 2
            'language'   => 'English-speaking local guide',
            'dress'      => 'Smart casual (temple-appropriate)',
            'activity'   => 'Easy walk & boat ride',
            'child'      => 'Children welcome',
            'cancel'     => 'Free ≥15 days; 50% for 14–8 days; 100% ≤7 days',
            'badges'     => ['Exclusive','Private','Top Seller'],

            // จุดที่ 1: ยานพาหนะ
            'transport'  => 'Private air-conditioned car/van',

            // จุดที่ 3: ราคา + โปร
            'pricing' => [
                'headline' => 'USD 185 / person',
                'tiers'    => [
                    '1–2 pax: USD 185 / person',
                    '3–6 pax: USD 155 / person',
                ],
                'promo'    => 'Limited-time promotion — valid until 31 Dec 2025.',
            ],

            'note'       => 'Order may change due to local conditions.',
        ],

        // ✅ alias ต้องเขียน “slug เก่า” => “slug ปัจจุบัน”
        'bangkok-royal-tour' => 'bangkok-grand-palace-temple-tour',

        // Floating + Railway
        'floating-market-railway-tour' => [
            'duration'   => 'Full Day (≈ 7 hrs)',
            'start_end'  => 'Hotel pickup/drop in Bangkok',
            'start_time' => '07:30 AM start',
            'pickup'     => 'Central Bangkok hotels',
            'group'      => 'Small group (max 12)',
            'language'   => 'English guide included',
            'dress'      => 'Casual, sun protection recommended',
            'activity'   => 'Train + boat market walk',
            'child'      => 'Family friendly',
            'cancel'     => 'Free ≥15 days; 50% for 14–8 days; 100% ≤7 days',
        ],

        // Kanchanaburi / River Kwai
        'kanchanaburi-river-kwai-death-railway-tour' => [
            'duration'   => 'Full Day (≈ 10–11 hrs)',
            'start_end'  => 'Pickup & drop-off at hotel (Bangkok)',
            'start_time' => 'Morning start ≈ 07:00',
            'pickup'     => 'Bangkok hotels only',
            'group'      => 'Small group (max 12 pax)',
            'language'   => 'English-speaking guide, war history background',
            'dress'      => 'Casual (temples & jungle walk)',
            'activity'   => 'Moderate – walking + boat/train ride',
            'child'      => 'Suitable age 7+ (long ride)',
            'cancel'     => 'Free ≥15 days; 50% for 14–8 days; 100% ≤7 days',
        ],
        'river-kwai-wwii-adventure' => 'kanchanaburi-river-kwai-death-railway-tour',

        // Ayutthaya
        'ayutthaya-ancient-city' => [
            'duration'   => 'Full Day (≈ 9–10 hrs)',
            'start_end'  => 'Bangkok ⇄ Ayutthaya round trip',
            'start_time' => '07:30 AM',
            'pickup'     => 'Hotel pickup/drop in Bangkok',
            'group'      => 'Private or small group',
            'language'   => 'English local guide',
            'dress'      => 'Temple-appropriate clothing',
            'activity'   => 'Temple walk + boat tour',
            'child'      => 'Children welcome',
            'cancel'     => 'Free ≥15 days; 50% for 14–8 days; 100% ≤7 days',
        ],
        'ayutthaya-ancient-city-temples-tour' => 'ayutthaya-ancient-city',

        // Pattaya–Chanthaburi
        'pattaya-chanthaburi-adventure' => [
            'duration'   => '3 Days 2 Nights',
            'start_end'  => 'Start/End: Bangkok',
            'start_time' => 'Depart 08:00 (Day 1)',
            'pickup'     => 'Hotel pickup in Bangkok',
            'group'      => '4–12 pax (private on request)',
            'language'   => 'Thai-English bilingual leader',
            'dress'      => 'Beachwear + cultural temples',
            'activity'   => 'Homestay, beach, temple, local arts',
            'child'      => 'Family friendly',
            'cancel'     => 'Free ≥15 days; 50% for 14–8 days; 100% ≤7 days',
        ],
        'eastern-thailand-discovery' => 'pattaya-chanthaburi-adventure',

        // Thailand–Laos
        'roam-thailand-laos' => [
            'duration'   => '9 Days 8 Nights',
            'start_end'  => 'Start: Bangkok / End: Ubon Ratchathani',
            'start_time' => 'Meet Day 1 at 17:00',
            'pickup'     => 'Hotel meet-up, private van throughout',
            'group'      => 'Small group only',
            'language'   => 'English escort + Laos team',
            'dress'      => 'Casual + temple-appropriate',
            'activity'   => 'Adventure + cultural + nature',
            'child'      => 'Not recommended under 12',
            'cancel'     => 'Confirmation upon group formation',
        ],

        // TH–LA–VN
        'vietnam-laos-thailand-epic' => [
            'duration'   => '9 Days 8 Nights',
            'start_end'  => 'Start: Bangkok / End: Hoi An (Vietnam)',
            'start_time' => 'Meet Day 1 at 17:00',
            'pickup'     => 'Bangkok hotel meet-up',
            'group'      => 'Max 12 travelers',
            'language'   => 'Local escort (multi-country)',
            'dress'      => 'Light, comfortable, cultural-aware',
            'activity'   => 'Cross-border discovery',
            'child'      => 'Teenagers (12+) only',
            'cancel'     => 'Confirmation upon group formation',
        ],
        'thailand-laos-vietnam-discovery-tour' => 'vietnam-laos-thailand-epic',

        // Default
        'default' => [
            'duration'   => 'Full Day (≈ 7–8 hrs)',
            'start_end'  => 'Bangkok hotel pick-up & drop-off',
            'start_time' => 'Morning start ≈ 08:00',
            'pickup'     => 'Central Bangkok pick-up included',
            'group'      => 'Small group (private on request)',
            'language'   => 'English-speaking local guide',
            'dress'      => 'Shoulders & knees covered',
            'activity'   => 'Easy–Moderate (6–9k steps)',
            'child'      => 'Children welcome',
            'cancel'     => 'Free ≥15 days; 50% for 14–8 days; 100% ≤7 days',
        ],
    ];

    // resolve alias (string -> array)
    $resolved = $map[$tour->slug] ?? $map['default'];
    if (is_string($resolved)) {
        $resolved = $map[$resolved] ?? $map['default'];
    }

    // ปรับคีย์ group_size -> group หากหลงเหลือ
    if (isset($resolved['group_size']) && empty($resolved['group'])) {
        $resolved['group'] = $resolved['group_size'];
        unset($resolved['group_size']);
    }

    $quick = $resolved;

    // ส่งทั้งสองชื่อ ป้องกัน Blade ใช้ตัวแปรคนละชื่อ
    return view('tours.show', [
        'tour' => $tour,
        'quick' => $quick,
        'quickInfo' => $quick,
    ]);
}


    // แสดงวันเดินทางของทัวร์
    public function showDepartures($id)
    {
        $tour = Tour::findOrFail($id);
        $departures = $tour->departures;
        return view('tours.departures', compact('tour', 'departures'));
    }

    // แสดงฟอร์มจองทัวร์
    public function showBooking($tourId, $departureId)
    {
        $tour = Tour::findOrFail($tourId);
        $departure = $tour->departures()->findOrFail($departureId);
        return view('bookings.create', compact('tour', 'departure'));
    }
}
