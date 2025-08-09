<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
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
        $overseasTours[] = [
            'image' => $filename,
            'title' => $tourCode,
            'desc' => '', // เพิ่ม desc ได้ถ้ามี
            'pdf' => $pdfFile,
        ];
    }

    return view('home', compact('overseasTours'));
}
}