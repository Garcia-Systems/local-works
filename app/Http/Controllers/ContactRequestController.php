<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\NewContactRequestNotification;
use App\Models\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactRequestController extends Controller
{
    public function store(StoreContactRequest $request): RedirectResponse
    {
        $attribution = $request->session()->get('first_touch', []);
        $contactRequest = ContactRequest::create(array_merge(
            $request->safe()->except('company_fax'),
            collect($attribution)->only(['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'referrer', 'landing_page'])->all(),
        ));

        try {
            Mail::to(config('services.local_works.intake_email'))->send(new NewContactRequestNotification($contactRequest));
        } catch (Throwable $exception) {
            Log::error('Contact request notification failed.', ['contact_request_id' => $contactRequest->id]);
        }

        return redirect()->route('contact.thank-you')->with('contact_submitted', true);
    }
}
