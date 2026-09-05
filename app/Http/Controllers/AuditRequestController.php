<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuditRequest;
use App\Mail\NewAuditRequestNotification;
use App\Models\AuditRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class AuditRequestController extends Controller
{
    public function store(StoreAuditRequest $request): RedirectResponse
    {
        $attribution = collect($request->session()->get('first_touch', []))
            ->only(['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'referrer', 'landing_page'])
            ->all();

        $auditRequest = AuditRequest::create(array_merge($request->safe()->except('company_fax'), $attribution));

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
