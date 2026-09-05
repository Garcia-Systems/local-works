@extends('layouts.public')

@section('title', 'Contact Local Works | Local Works')
@section('meta_description', 'Contact Local Works by Garcia Systems with a general question, referral, business inquiry, or potential collaboration.')

@section('content')
    <div data-page="contact">
        <x-page-introduction eyebrow="Contact" title="Start a conversation.">
            If you have a workflow problem to investigate, the Digital Friction Audit is usually the best place to start. For general questions or other inquiries, send Local Works a message here.
            <x-slot:actions><a class="button button-primary" href="{{ route('digital-friction-audit') }}" data-analytics-event="audit_cta_click" data-analytics-location="contact_hero">Request a Digital Friction Audit</a></x-slot:actions>
        </x-page-introduction>

        <section class="section-space bg-warm-100" aria-labelledby="path-title">
            <div class="site-container"><div class="max-w-3xl"><p class="eyebrow mb-4">Choose a starting point</p><h2 id="path-title" class="section-heading">Which path should I use?</h2></div>
                <div class="contact-paths mt-10">
                    <article><p class="eyebrow">For a specific workflow</p><h3>Digital Friction Audit</h3><p>Use this when customers or staff are struggling with a workflow, you want a process investigated, or you are unsure whether configuration, integration, automation, custom work, or no change is appropriate.</p><a class="button button-primary mt-6" href="{{ route('digital-friction-audit') }}" data-analytics-event="audit_cta_click" data-analytics-location="contact_audit_path">Request an Audit</a></article>
                    <article><p class="eyebrow">For everything else</p><h3>General Contact</h3><p>Use this for general questions, referrals, business inquiries, potential collaboration, implementation-related conversation, or anything that does not fit the audit request.</p><a class="button button-secondary mt-6" href="#general-contact">Send a General Message</a></article>
                </div>
            </div>
        </section>

        <section id="general-contact" class="audit-intake scroll-mt-24" aria-labelledby="contact-form-title" tabindex="-1">
            <div class="site-container section-space grid items-start gap-10 lg:grid-cols-[.72fr_1.28fr] lg:gap-16">
                <div><p class="eyebrow mb-4">General contact</p><h2 id="contact-form-title" class="section-heading">Send Local Works a message.</h2><p class="body-copy mt-5">Provide the basics and your message. Local Works will review it and use the details you provide to respond. A specific response time is not promised.</p><ol class="next-steps mt-8" aria-label="What happens after sending a message"><li><h3>Your message is recorded</h3><p>The submission is stored so it is not dependent on email delivery alone.</p></li><li><h3>Local Works is notified</h3><p>The same configured intake recipient used for audit requests receives the message.</p></li><li><h3>The inquiry is reviewed</h3><p>Local Works will consider the appropriate next conversation or action.</p></li></ol></div>
                <div class="audit-form-surface">
                    @if ($errors->any())
                        <div id="contact-form-errors" class="form-error-summary" role="alert" tabindex="-1" data-validation-errors><strong>Please review the highlighted fields.</strong><span>Your message has not been submitted yet.</span></div>
                    @endif
                    <form class="audit-form mt-8" action="{{ route('contact-requests.store') }}" method="POST" aria-describedby="contact-privacy-note{{ $errors->any() ? ' contact-form-errors' : '' }}" data-contact-form data-analytics-form="general-contact">
                        @csrf
                        <div class="honeypot" aria-hidden="true"><label for="contact_company_fax">Leave this field empty</label><input id="contact_company_fax" name="company_fax" type="text" tabindex="-1" autocomplete="off"></div>
                        <fieldset><legend>Your details</legend><p class="form-group-help"><span aria-hidden="true">*</span> indicates a required field.</p><div class="form-grid mt-6">
                            <div class="field sm:col-span-2"><label for="contact_name">Name <span aria-hidden="true">*</span><span class="sr-only"> (required)</span></label><input id="contact_name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required aria-required="true" aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}" aria-describedby="contact-name-help{{ $errors->has('name') ? ' contact-name-error' : '' }}" @if($errors->has('name')) autofocus @endif><p id="contact-name-help">Your full name.</p>@error('name')<p id="contact-name-error" class="field-error">{{ $message }}</p>@enderror</div>
                            <div class="field"><label for="contact_email">Email <span aria-hidden="true">*</span><span class="sr-only"> (required)</span></label><input id="contact_email" name="email" type="email" value="{{ old('email') }}" inputmode="email" autocomplete="email" required aria-required="true" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" aria-describedby="contact-email-help{{ $errors->has('email') ? ' contact-email-error' : '' }}"><p id="contact-email-help">An address you check.</p>@error('email')<p id="contact-email-error" class="field-error">{{ $message }}</p>@enderror</div>
                            <div class="field"><label for="contact_phone">Phone <span class="field-status">Optional</span></label><input id="contact_phone" name="phone" type="tel" value="{{ old('phone') }}" inputmode="tel" autocomplete="tel" aria-invalid="{{ $errors->has('phone') ? 'true' : 'false' }}" aria-describedby="contact-phone-help{{ $errors->has('phone') ? ' contact-phone-error' : '' }}"><p id="contact-phone-help">Include it only if a call is convenient.</p>@error('phone')<p id="contact-phone-error" class="field-error">{{ $message }}</p>@enderror</div>
                            <div class="field sm:col-span-2"><label for="contact_business_name">Business / organization <span class="field-status">Optional</span></label><input id="contact_business_name" name="business_name" type="text" value="{{ old('business_name') }}" autocomplete="organization" aria-invalid="{{ $errors->has('business_name') ? 'true' : 'false' }}" aria-describedby="contact-business-help{{ $errors->has('business_name') ? ' contact-business-error' : '' }}"><p id="contact-business-help">The organization connected to your inquiry, if any.</p>@error('business_name')<p id="contact-business-error" class="field-error">{{ $message }}</p>@enderror</div>
                            <div class="field sm:col-span-2"><label for="contact_message">Message <span aria-hidden="true">*</span><span class="sr-only"> (required)</span></label><textarea id="contact_message" name="message" rows="7" required aria-required="true" aria-invalid="{{ $errors->has('message') ? 'true' : 'false' }}" aria-describedby="contact-message-help{{ $errors->has('message') ? ' contact-message-error' : '' }}">{{ old('message') }}</textarea><p id="contact-message-help">What would you like Local Works to know?</p>@error('message')<p id="contact-message-error" class="field-error">{{ $message }}</p>@enderror</div>
                        </div></fieldset>
                        <div><p id="contact-privacy-note" class="privacy-note">Your information is used to review and respond to this inquiry. Do not send passwords, sensitive credentials, or other confidential access information. Read the <a href="{{ route('privacy') }}">privacy notice</a>.</p><button class="button button-primary mt-6 w-full sm:w-auto" type="submit" data-cta-location="general-contact-submit">Send Message</button></div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
