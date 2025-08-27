<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function partners(): View
    {
        $sponsors = Sponsor::all();
        $tiers = $sponsors->groupBy('tier');

        $tierColors = [
            'gold' => 'border-yellow-400',
            'silver' => 'border-gray-300',
            'bronze' => 'border-orange-400',
        ];

        return view('partners', compact('sponsors', 'tiers', 'tierColors'));
    }
}
