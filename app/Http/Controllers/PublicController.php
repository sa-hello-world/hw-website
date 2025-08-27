<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use App\Models\Sponsor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PublicController extends Controller
{
    /**
     * Returns the public facing partners page
     * @return View
     */
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

    public function contact(): View {
        return view('contact');
    }

    /**
     * Validates and send the message to the default HW email or
     * to the one in the env (if such exists)
     * @returns RedirectResponse
     */
    public function send(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' =>[
                'required',
                'email',
                'max:255',
                'min:3',
                Rule::email()
                    ->rfcCompliant()
                    ->validateMxRecord()
                    ->preventSpoofing()
            ],
            'subject' => 'required|string',
            'message' => 'required|string|min:8',
        ]);

        // makes the Email dynamic with the .env
        $recipientEmail = trim((string)config('app.email'));
        Mail::to($recipientEmail)->send(new ContactUs($data));


        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon.');
    }
}
