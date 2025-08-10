<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class HomeController extends Controller
{
    public function index()
    {
        $tours = Tour::query()
            ->where('is_popular', 1)
            ->orderByDesc('updated_at')
            ->take(12)
            ->get();

        // Fallback: if none are marked popular yet, show latest tours instead
        if ($tours->isEmpty()) {
            $tours = Tour::query()
                ->orderByDesc('updated_at')
                ->take(12)
                ->get();
        }

        // Overseas/Outbound tours (from highlight-outbounds folder)
        $highlightPath = storage_path('app/public/highlight-outbounds');
        $images = glob($highlightPath . '/*.jpg');
        $pdfs = glob($highlightPath . '/*.pdf');

        $overseasTours = [];
        foreach ($images as $img) {
            $filename = basename($img);
            $tourCode = pathinfo($filename, PATHINFO_FILENAME);
            $pdfFile = null;
            foreach ($pdfs as $pdf) {
                if (strpos($pdf, $tourCode) !== false) {
                    $pdfFile = basename($pdf);
                    break;
                }
            }
            // Overseas/Outbound tours (ดึงจาก config/outbound.php)
            $overseasTours = collect(config('outbound.home', []))
                ->map(function ($t) {
                    $img = $t['image'] ?? null;
                    $pdf = $t['pdf'] ?? null;

                    $imgOk = $img && file_exists(storage_path("app/public/highlight-outbounds/{$img}"));
                    $pdfOk = $pdf && file_exists(storage_path("app/public/highlight-outbounds/{$pdf}"));

                    return [
                        'title' => $t['title'] ?? '',
                        'image' => $imgOk ? $img : null,
                        'pdf'   => $pdfOk ? $pdf : null,
                        'desc'  => $t['desc'] ?? '',
                    ];
                })
                ->filter(fn($x) => !empty($x['image'])) // ต้องมีรูปเท่านั้น
                ->values()
                ->all();
        }

        return view('home', compact('tours', 'overseasTours'));
    }
}
