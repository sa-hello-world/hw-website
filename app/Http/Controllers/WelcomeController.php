<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::all();
        return view('welcome', compact('sponsors'));
    }
}
