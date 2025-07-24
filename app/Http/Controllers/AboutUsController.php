<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class AboutUsController extends Controller
{
    /**
     * @return \Illuminate\View\View
     * Get 6 random image filenames from /public/img/aboutUs
     * */
    public function index(): View
    {
        $imageFiles = collect(File::files(public_path('img/aboutUs')))
            ->filter(fn($file) => $file->getExtension() === 'jpg' || $file->getExtension() === 'png')
            ->shuffle()
            ->take(6)
            ->map(fn($file) => 'img/aboutUs/' . $file->getFilename());

        return view('aboutus', ['galleryImages' => $imageFiles]);
    }
}
