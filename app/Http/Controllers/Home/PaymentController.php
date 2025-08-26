<?php

namespace App\Http\Controllers\Home;

use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index() : View
    {
        $payments = Auth::user()->payments()->orderBy('created_at', 'desc')->get();

        return view('home.payments.index', compact('payments'));
    }
}
