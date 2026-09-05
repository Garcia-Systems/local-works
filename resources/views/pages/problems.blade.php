@extends('layouts.public')

@section('title', 'Problems We Investigate')
@section('meta_description', 'Local Works investigates unnecessary customer and staff workflow friction, repetitive work, and disconnected systems to find the simplest sensible response.')

@section('content')
    <div data-page="problems">
        <x-page-introduction eyebrow="Problems We Investigate" title="Where is the work getting harder than it needs to be?">
            Local Works looks at customer and staff workflows to identify unnecessary effort, disconnected steps, and repetitive work—then investigates whether the problem is worth solving and what the simplest sensible response might be.
            <x-slot:actions>
                <a class="button button-primary" href="{{ route('digital-friction-audit') }}" data-analytics-event="audit_cta_click" data-analytics-location="problems_hero">Request a Digital Friction Audit</a>
                <a class="button button-secondary" href="{{ route('how-it-works') }}">See How It Works</a>
            </x-slot:actions>
        </x-page-introduction>

        <section class="section-space bg-warm-100" aria-labelledby="moment-title">
            <div class="site-container grid gap-10 lg:grid-cols-[.75fr_1.25fr] lg:gap-20">
                <div><p class="eyebrow mb-4">Recognition before technology</p><h2 id="moment-title" class="section-heading">Start with the frustrating moment.</h2><p class="body-copy mt-5">We do not begin with “What software should we buy?”, “What should we automate?”, or “What should we build?”</p></div>
                <div><p class="body-large">Begin with what customers and staff experience.</p><ul class="question-list mt-7"><li>Where do customers get stuck?</li><li>Where do staff repeat work?</li><li>Where do people wait unnecessarily?</li><li>Where does information move manually?</li><li>Where do memory, inboxes, or spreadsheets hold a process together?</li><li>Where does a simple request become a chain of calls and emails?</li></ul></div>
            </div>
        </section>

        <section class="section-space bg-white" aria-labelledby="self-service-title">
            <div class="site-container problem-detail">
                <div><p class="eyebrow mb-4">Customer self-service</p><h2 id="self-service-title" class="section-heading">Customers have to ask for help with something routine.</h2><p class="body-copy mt-5">Account changes, pauses, cancellations, information updates, and status checks may depend on staffed hours or an in-person visit. That can burden both the customer and the employee handling the request.</p><p class="body-copy mt-4">Human review may still serve a legitimate business rule. Self-service is a possibility, not a foregone conclusion.</p></div>
                <aside class="example-panel" aria-labelledby="membership-example-title"><p class="eyebrow">Example</p><h3 id="membership-example-title">A hypothetical membership workflow</h3><p>A membership business allows customers to join online, but pausing, updating billing information, or canceling requires a phone call or visit.</p><h4>Questions to investigate</h4><ul><li>How often do these requests happen?</li><li>What does staff do during the call?</li><li>Does the current platform support self-service?</li><li>Do business rules require human review?</li><li>Would a change improve the economics or experience?</li></ul></aside>
            </div>
        </section>

        <section class="section-space border-y border-warm-200 bg-local-50" aria-labelledby="scheduling-title">
            <div class="site-container"><div class="max-w-3xl"><p class="eyebrow mb-4">Appointments and scheduling</p><h2 id="scheduling-title" class="section-heading">Scheduling becomes a conversation instead of a transaction.</h2><p class="body-copy mt-5">Customers may be unable to see availability while staff coordinate times, transfer details, send confirmations, and manage changes across different calendars.</p></div>
                <figure class="example-flow mt-10"><figcaption><span>Example workflow</span>Each step is understandable, but the handoffs can create waiting and repeated work.</figcaption><ol><li>Website inquiry</li><li>Shared inbox</li><li>Staff callback</li><li>Calendar entry</li><li>Confirmation</li></ol></figure>
                <div class="possibility-strip mt-8"><p><strong>Possible responses:</strong> configure an existing scheduling feature, use an established product, connect the website and calendar, automate confirmations—or leave the workflow alone when the volume does not justify change.</p></div>
            </div>
        </section>

        <section class="section-space bg-white" aria-labelledby="inquiries-title">
            <div class="site-container problem-detail"><div><p class="eyebrow mb-4">Leads and inquiries</p><h2 id="inquiries-title" class="section-heading">An inquiry comes in, then everyone hopes someone remembers it.</h2><p class="body-copy mt-5">Website inquiries land in a shared inbox. Social messages and voicemail form separate streams. Someone maintains a spreadsheet, follow-up depends on memory, and prospects cannot tell whether a request was received.</p><p class="body-copy mt-4">That does not mean every business needs a custom CRM. Clear ownership and a simple process may be enough.</p></div><div><h3 class="text-xl">Responses worth comparing</h3><ul class="lined-list mt-5"><li>Configure an existing CRM.</li><li>Improve inbox ownership and follow-up rules.</li><li>Connect forms to a tool already in use.</li><li>Send an automatic acknowledgement.</li><li>Keep the current approach if it is sufficient.</li></ul></div></div>
        </section>

        <section class="section-space border-y border-warm-200 bg-warm-100" aria-labelledby="intake-title">
            <div class="site-container problem-detail"><div><p class="eyebrow mb-4">Customer intake</p><h2 id="intake-title" class="section-heading">Customers enter information once. Staff enter it again.</h2><p class="body-copy mt-5">An online inquiry, registration, waiver, service intake, application, or reservation request may be manually transferred into another system. Duplicate entry can consume time, delay processing, introduce typing mistakes, and create inconsistent records.</p></div><div class="question-surface"><h3>Before reaching for an API</h3><ul><li>Why are there two systems?</li><li>Is the second entry actually required?</li><li>Can the current tools integrate?</li><li>Does a native connector already exist?</li><li>Would an export and import be enough?</li><li>Is the volume high enough for automation to matter?</li></ul></div></div>
        </section>

        <section class="section-space bg-white" aria-labelledby="handoffs-title">
            <div class="site-container"><div class="max-w-3xl"><p class="eyebrow mb-4">Staff handoffs</p><h2 id="handoffs-title" class="section-heading">The process crosses teams, but the information does not.</h2><p class="body-copy mt-5">Sales, operations, the front desk, accounting, and service staff can each hold a different version of the same work. Screenshots travel by email, work sits in personal inboxes, and one person becomes the unofficial bridge.</p></div>
                <figure class="example-flow mt-10"><figcaption><span>Example</span>A hypothetical cross-team workflow—not a customer case study.</figcaption><ol><li>Inquiry</li><li>Sales notes</li><li>Operations spreadsheet</li><li>Payment system</li><li>Service team</li></ol></figure>
                <p class="body-copy mt-7 max-w-4xl">The investigation traces ownership, handoff points, duplicate records, the source of truth, error risk, and capabilities already available in each system.</p>
            </div>
        </section>

        <section class="section-space bg-local-800 text-white" aria-labelledby="systems-title">
            <div class="site-container problem-detail"><div><p class="eyebrow mb-4 !text-local-200">Disconnected systems</p><h2 id="systems-title" class="section-heading">The tools work. They just don't work together.</h2><p class="mt-5 text-lg leading-8 text-local-100">A business may already own capable tools for scheduling, payments, CRM, memberships, accounting, forms, email, or inventory. The friction can live between them.</p><ul class="dark-list mt-7"><li>Customer details are copied manually.</li><li>Payment status is checked elsewhere.</li><li>Spreadsheet exports pass between teams.</li><li>IDs and reference numbers are re-entered.</li><li>Systems disagree about status.</li></ul></div><div class="dark-question-surface"><h3>Integration is only one possibility.</h3><p>First determine whether a connection is needed, whether a native connector or configuration can solve it, whether the process can be simplified, and whether the volume justifies technical work.</p></div></div>
        </section>

        <section class="section-space bg-white" aria-labelledby="repetition-title">
            <div class="site-container"><div class="max-w-3xl"><p class="eyebrow mb-4">Repetitive administration</p><h2 id="repetition-title" class="section-heading">People spend time repeating steps that require little judgment.</h2><p class="body-copy mt-5">Sending the same confirmation, copying data, generating reminders, checking status, moving files, reconciling records, or preparing the same report may be mechanical repetition. Human work itself is not the problem.</p></div><div class="work-contrast mt-10"><article><h3>Judgment work</h3><p>Decisions, exceptions, relationships, and context where a person adds value.</p></article><article><h3>Mechanical repetition</h3><p>Understood, repeated, stable steps that may be suitable for automation when the volume supports it.</p></article></div></div>
        </section>

        <section class="section-space border-y border-warm-200 bg-local-50" aria-labelledby="finish-title">
            <div class="site-container problem-detail"><div><p class="eyebrow mb-4">Payments and registration</p><h2 id="finish-title" class="section-heading">The process breaks apart right before the customer finishes.</h2><p class="body-copy mt-5">Registration and payment may happen in separate systems. Staff manually confirm payment, customers wait for a payment link, reservations and deposits are tracked apart, or a refund requires several manual steps.</p></div><div><h3 class="text-xl">The simplest sensible outcome might be…</h3><ul class="lined-list mt-5"><li>Configure the current platform.</li><li>Consolidate tools.</li><li>Integrate systems.</li><li>Automate confirmation.</li><li>Leave the process alone when complexity or volume is low.</li></ul></div></div>
        </section>

        <section class="section-space bg-white" aria-labelledby="status-title">
            <div class="site-container problem-detail"><div><p class="eyebrow mb-4">Status and communication</p><h2 id="status-title" class="section-heading">Customers don't know what happens next.</h2><p class="body-copy mt-5">An inquiry receives no acknowledgement. Customers call for updates or ask, “Did you get my form?” Different employees provide different answers because status depends on manual outreach.</p></div><div class="question-surface"><h3>Sometimes no new application is needed.</h3><p>Clearer copy, better confirmation messages, automated email, useful status communication, better ownership, or configuration of an existing tool may solve the practical problem.</p></div></div>
        </section>

        <section class="section-space border-y border-warm-200 bg-warm-100" aria-labelledby="paper-title">
            <div class="site-container problem-detail"><div><p class="eyebrow mb-4">Paper and physical processes</p><h2 id="paper-title" class="section-heading">A digital process stops because one step still depends on paper or presence.</h2><p class="body-copy mt-5">Print and sign, scan and email, handwritten intake, physical form transfer, an administrative visit, or later re-entry into a system can interrupt an otherwise digital workflow.</p></div><div><p class="body-large">Older-looking is not the same as unnecessary.</p><p class="body-copy mt-4">Legal or safety requirements, identity verification, customer preferences, and operational realities may justify paper or presence. Local Works investigates the burden and the reason—not appearances.</p></div></div>
        </section>

        <section class="section-space bg-ink text-white" aria-labelledby="worth-title">
            <div class="site-container"><div class="max-w-3xl"><p class="eyebrow mb-4 !text-local-200">The hidden question</p><h2 id="worth-title" class="section-heading">Is the problem actually worth solving?</h2><p class="mt-5 text-lg leading-8 text-stone-300">Recognizing friction is only the first step. A meaningful investigation compares the burden of today with the cost and responsibility of change.</p></div><ul class="worth-grid mt-10"><li>How often does it happen?</li><li>Who experiences it?</li><li>How much effort does it create?</li><li>Does it cause mistakes?</li><li>Does it frustrate customers?</li><li>Does it affect revenue or retention?</li><li>What does the workaround cost?</li><li>What would a solution cost?</li><li>What support would change create?</li><li>What happens if nothing changes?</li></ul><p class="principle-callout mt-10">The response should not cost more—in money, time, or complexity—than the problem is reasonably worth.</p></div>
        </section>

        <section class="section-space bg-warm-100" aria-labelledby="outcomes-title">
            <div class="site-container"><div class="max-w-3xl"><p class="eyebrow mb-4">Possible outcomes</p><h2 id="outcomes-title" class="section-heading">Finding friction does not determine the solution.</h2><p class="body-copy mt-5">These are alternatives, not levels. Custom software is not the preferred destination.</p></div><div class="outcome-grid mt-10" aria-label="Alternative responses to workflow friction">@foreach ([['Configure', 'Use existing systems more effectively.'], ['Integrate', 'Connect systems where the manual handoff is the problem.'], ['Automate', 'Remove stable, repetitive work.'], ['Custom Build', 'Create new software only when existing approaches are insufficient and the economics justify it.'], ['Leave Alone', 'Accept the workflow when the cost or complexity of change exceeds the likely value.']] as [$outcome, $copy])<article><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $outcome }}</h3><p>{{ $copy }}</p></article>@endforeach</div><div class="mt-8"><a class="button button-primary" href="{{ route('digital-friction-audit') }}" data-analytics-event="audit_cta_click" data-analytics-location="problems_audit_section">Request a Digital Friction Audit</a></div></div>
        </section>

        <section class="section-space bg-white" aria-labelledby="industries-title">
            <div class="site-container problem-detail"><div><p class="eyebrow mb-4">Industry context</p><h2 id="industries-title" class="section-heading">These problems appear across many kinds of businesses.</h2><p class="body-copy mt-5">The common denominator is <strong class="text-ink">repeatable workflows involving customers, staff, and systems.</strong> These are possible settings, not claims of clients or industry specialization.</p></div><ul class="tag-list" aria-label="Example business settings">@foreach (['Gyms and fitness', 'Restaurants', 'Music and dance studios', 'Membership organizations', 'Appointment-based services', 'Trades', 'Recreation businesses', 'Local shops', 'Professional services', 'Community organizations'] as $type)<li>{{ $type }}</li>@endforeach</ul></div>
        </section>

        <section class="section-space border-y border-warm-200 bg-local-50" aria-labelledby="hearing-title">
            <div class="site-container"><div class="max-w-3xl"><p class="eyebrow mb-4">A recognition check</p><h2 id="hearing-title" class="section-heading">A workflow may be worth investigating if you keep hearing things like…</h2><p class="body-copy mt-5">These are familiar phrases, not testimonials.</p></div><ul class="quote-grid mt-10">@foreach (["Just call us.", "I'll email that to you.", "Let me copy that over.", "It's in the spreadsheet.", "I'll check with the other department.", "Can you send that information again?", "We're waiting for someone to call back.", "I have to update both systems.", "Only one person knows how to do that.", "Customers keep asking whether we received it."] as $phrase)<li>“{{ $phrase }}”</li>@endforeach</ul></div>
        </section>

        <section class="bg-local-800 text-white" aria-labelledby="final-title">
            <div class="site-container section-space text-center"><p class="eyebrow mb-4 !text-local-200">Digital Friction Audit</p><h2 id="final-title" class="mx-auto max-w-4xl text-3xl leading-tight sm:text-4xl lg:text-5xl">Recognize one of these patterns in your business?</h2><p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-local-100">You do not need to know what technology would fix it. Start by describing the workflow and how it works today.</p><div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row"><a class="button button-secondary" href="{{ route('digital-friction-audit') }}" data-analytics-event="audit_cta_click" data-analytics-location="problems_final">Request a Digital Friction Audit</a><a class="button border-local-200 bg-transparent text-white hover:bg-white/10" href="{{ route('how-it-works') }}">See How Local Works Investigates</a></div></div>
        </section>
    </div>
@endsection
