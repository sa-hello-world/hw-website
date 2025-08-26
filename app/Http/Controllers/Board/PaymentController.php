<?php

namespace App\Http\Controllers\Board;

use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
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
        if (Auth::user()->cannot('viewAny', Payment::class)) {
            abort(403);
        }

        $payments = Payment::orderBy('created_at', 'desc')->paginate(10);
        $openPaymentsCount = Payment::where('status', PaymentStatus::PENDING->value)->count();

        return view('board.payments.index', compact('payments', 'openPaymentsCount'));
    }
}
