<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuditRequest;
use App\Mail\NewAuditRequestNotification;
use App\Models\AuditRequest;
use App\Services\TurnstileVerifier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class AuditRequestController extends Controller
{
    public function store(StoreAuditRequest $request, TurnstileVerifier $turnstile): RedirectResponse
    {
        if (! $turnstile->verify($request->string('cf-turnstile-response')->toString(), $request->ip())) {
            return redirect(route('digital-friction-audit').'#audit-intake')
                ->withErrors(['cf-turnstile-response' => "We couldn't verify your submission. Please try again."])
                ->withInput();
        }

        $attribution = collect($request->session()->get('first_touch', []))
            ->only(['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'referrer', 'landing_page'])
            ->all();

        $auditRequest = AuditRequest::create(array_merge($request->safe()->except(['company_fax', 'cf-turnstile-response']), $attribution));

        try {
            Mail::to(config('services.local_works.intake_email'))->send(new NewAuditRequestNotification($auditRequest));
        } catch (Throwable $exception) {
            Log::error('Audit request notification could not be sent.', [
                'audit_request_id' => $auditRequest->getKey(),
                'route' => $request->route()->getName(),
                'exception_class' => $exception::class,
            ]);
        }

        return redirect()->route('thank-you')->with('audit_submitted', true);
    }
}
