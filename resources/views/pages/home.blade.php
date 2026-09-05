@extends('layouts.public')

@section('title', 'Make your business easier to use')
@section('meta_description', 'Local Works helps businesses find frustrating customer and staff workflows and choose the simplest practical way to improve them.')

@section('content')
    <section class="relative overflow-hidden bg-white" aria-labelledby="home-title">
        <div class="site-container grid items-center gap-12 py-16 sm:py-20 lg:grid-cols-[1.08fr_.92fr] lg:gap-16 lg:py-28">
            <div class="relative z-10 max-w-3xl">
                <p class="eyebrow mb-5">Practical workflow improvement</p>
                <h1 id="home-title" class="display-heading">Make your business easier to use.</h1>
                <p class="body-large mt-7 max-w-2xl">Local Works helps businesses find frustrating customer and staff workflows, then determine the simplest practical way to improve them.</p>
                <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                    <a class="button button-primary" href="{{ route('digital-friction-audit') }}" data-cta-location="hero">Request a Digital Friction Audit</a>
                    <a class="button button-secondary" href="{{ route('how-it-works') }}">See How It Works</a>
                </div>
            </div>

            <div class="workflow-map" aria-hidden="true">
                <div class="workflow-map__header"><span>One everyday workflow</span><span>Made simpler</span></div>
                <div class="workflow-map__path">
                    <span>Customer asks</span><i></i><span>Staff responds</span><i></i><span>Work gets done</span>
                </div>
                <div class="workflow-map__friction">
                    <span class="workflow-map__mark">!</span>
                    <div><strong>Unnecessary effort lives in the gaps.</strong><small>We look closely before recommending a change.</small></div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-warm-200 bg-warm-100" aria-labelledby="familiar-title">
        <div class="site-container section-space grid gap-10 lg:grid-cols-[.75fr_1.25fr] lg:gap-20">
            <div>
                <p class="eyebrow mb-4">Common workflow friction</p>
                <h2 id="familiar-title" class="section-heading">Does this sound familiar?</h2>
                <p class="body-copy mt-5 max-w-md">These are everyday scenarios—not customer stories. Small obstacles can add up for the people buying from you and the people doing the work.</p>
            </div>
            <ul class="scenario-list">
                <li>Customers have to call to do something that should take 30 seconds online.</li>
                <li>Employees copy the same information from one system into another.</li>
                <li>Website inquiries disappear into email and spreadsheets.</li>
                <li>Customers submit a request but do not know what happens next.</li>
            </ul>
        </div>
    </section>

    <section class="section-space bg-white" aria-labelledby="what-we-do-title">
        <div class="site-container grid gap-10 lg:grid-cols-2 lg:gap-20">
            <div>
                <p class="eyebrow mb-4">What Local Works does</p>
                <h2 id="what-we-do-title" class="section-heading max-w-xl">Look at how the work really happens.</h2>
            </div>
            <div class="max-w-2xl">
                <p class="body-large">We examine how customers and employees get things done, identify unnecessary friction, and determine whether fixing it is worthwhile.</p>
                <p class="body-copy mt-5">The current workflow comes first. Then evidence and economics. Only then do we help choose the simplest sensible response.</p>
                <div class="principle-line mt-8" aria-label="Local Works working principles">
                    <span>Workflow first</span><span>Evidence first</span><span>Economics before implementation</span>
                </div>
            </div>
        </div>
    </section>

    <section class="section-space border-y border-warm-200 bg-warm-50" aria-labelledby="method-title">
        <div class="site-container">
            <div class="reading-container mb-10">
                <p class="eyebrow mb-4">A grounded methodology</p>
                <h2 id="method-title" class="section-heading">Understand before choosing.</h2>
                <p class="body-copy mt-5">A clear path from an observed frustration to a reasoned decision.</p>
            </div>
            <ol class="method-steps" aria-label="Local Works methodology">
                @foreach ([
                    ['Observe', 'Where are customers or employees doing unnecessary work?'],
                    ['Understand', 'How does the process actually work today?'],
                    ['Measure', 'Is the problem important or expensive enough to change?'],
                    ['Choose', 'What is the simplest sensible response?'],
                    ['Deliver', 'If action is justified, define and coordinate the right approach.'],
                ] as [$step, $description])
                    <li>
                        <span class="method-steps__number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div><h3>{{ $step }}</h3><p>{{ $description }}</p></div>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="section-space bg-local-800 text-white" aria-labelledby="decisions-title">
        <div class="site-container">
            <div class="max-w-3xl">
                <p class="eyebrow mb-4 !text-local-200">The right answer, not the biggest one</p>
                <h2 id="decisions-title" class="section-heading">Not every problem needs custom software.</h2>
                <p class="mt-5 text-lg leading-8 text-local-100">These are alternative decisions—not a ladder. The goal is to choose only what the evidence supports.</p>
            </div>
            <ul class="decision-grid mt-12" aria-label="Possible solution decisions">
                @foreach ([
                    ['Configure', 'Use what the business already owns more effectively.'],
                    ['Integrate', 'Connect existing systems.'],
                    ['Automate', 'Remove repetitive manual work.'],
                    ['Custom Build', 'Create something new only when the problem and economics justify it.'],
                    ['Leave Alone', 'Sometimes changing the process costs more than the problem is worth.'],
                ] as [$decision, $description])
                    <li><span aria-hidden="true">{{ $loop->iteration }}</span><h3>{{ $decision }}</h3><p>{{ $description }}</p></li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="section-space bg-white" aria-labelledby="problems-title">
        <div class="site-container">
            <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                <div class="max-w-2xl"><p class="eyebrow mb-4">Examples, not case studies</p><h2 id="problems-title" class="section-heading">Problems we investigate</h2><p class="body-copy mt-5">Recognizable places where a routine journey can become harder than it needs to be.</p></div>
                <a class="button button-secondary shrink-0 self-start md:self-auto" href="{{ route('problems') }}" data-cta-location="problems">See Problems We Investigate</a>
            </div>
            <div class="problem-list mt-12">
                @foreach ([
                    ['Membership management', 'Joining is easy, but pausing, changing billing information, or canceling requires a call or visit.'],
                    ['Appointment scheduling', 'A website inquiry becomes a voicemail, callback, calendar entry, and spreadsheet row.'],
                    ['Private events', 'A request moves between social messages, email, phone calls, and separate payment tools.'],
                    ['Customer intake', 'Customers submit information online, then staff manually copy it into another system.'],
                    ['Staff handoffs', 'One department maintains information in one system while another keeps a second version elsewhere.'],
                ] as [$problem, $description])
                    <article><span aria-hidden="true">0{{ $loop->iteration }}</span><h3>{{ $problem }}</h3><p>{{ $description }}</p></article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-space border-y border-warm-200 bg-warm-100" aria-labelledby="audit-title">
        <div class="site-container grid gap-12 lg:grid-cols-[.8fr_1.2fr] lg:gap-20">
            <div>
                <p class="eyebrow mb-4">Digital Friction Audit</p>
                <h2 id="audit-title" class="section-heading">Start with the workflow, not the software.</h2>
                <p class="body-copy mt-5">An audit investigates the relevant parts of the customer journey and the staff work behind them. It looks for unnecessary calls, emails, printing, waiting, repeated information, manual transfers, disconnected systems, and avoidable visits.</p>
                <p class="body-copy mt-4">An inconvenience is a clue, not proof. We ask questions and look for evidence before deciding whether action makes sense.</p>
                <a class="button button-primary mt-8" href="{{ route('digital-friction-audit') }}" data-cta-location="audit-section">Request a Digital Friction Audit</a>
            </div>
            <div class="space-y-8">
                <div><h3 class="text-lg font-semibold">The customer journey</h3><x-process-sequence class="mt-4" :items="['Find', 'Understand', 'Contact', 'Book / Join', 'Pay', 'Receive Service', 'Manage', 'Return']" label="Customer journey examined by the audit" /></div>
                <div class="audit-discipline"><p class="text-sm font-bold uppercase tracking-widest text-local-700">Audit discipline</p><p>Observed fact <span>→</span> Possible friction <span>→</span> Unknowns <span>→</span> Questions <span>→</span> Evidence <span>→</span> Decision</p></div>
            </div>
        </div>
    </section>

    <section class="section-space bg-white" aria-labelledby="economics-title">
        <div class="site-container grid items-start gap-10 lg:grid-cols-[1fr_.9fr] lg:gap-20">
            <div class="max-w-2xl">
                <p class="eyebrow mb-4">Economic discipline</p>
                <h2 id="economics-title" class="section-heading">Sometimes the right answer is to leave it alone.</h2>
                <p class="body-large mt-6">Changing a process has costs, too. We consider how meaningful the problem is, who experiences it, how often it occurs, what it costs today, and what a sensible improvement might cost.</p>
                <p class="body-copy mt-5">The question is not simply “Can this be changed?” It is “Is this actually worth pursuing?”</p>
            </div>
            <div class="evidence-path" aria-label="Decision discipline"><span>Problem</span><i>→</i><span>Evidence</span><i>→</i><span>Economics</span><i>→</i><strong>Decision</strong></div>
        </div>
    </section>

    <section class="border-y border-warm-200 bg-local-50" aria-labelledby="garcia-title">
        <div class="site-container section-space grid gap-10 lg:grid-cols-[.7fr_1.3fr] lg:gap-20">
            <div><p class="text-xl font-extrabold tracking-[.16em] text-ink">LOCAL WORKS</p><p class="mt-2 text-sm text-muted">by Garcia Systems</p></div>
            <div class="max-w-3xl">
                <h2 id="garcia-title" class="section-heading">Business improvement with practical delivery behind it.</h2>
                <p class="body-large mt-6">Local Works is the customer-facing business improvement initiative of Garcia Systems.</p>
                <p class="body-copy mt-5">When implementation is justified, Local Works helps determine the right delivery approach and coordinate the technical work. That could involve configuring an existing service, working with a vendor, integrating or automating tools, engaging the right specialist, building something focused, or supporting a customer’s internal team.</p>
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden bg-ink text-white" aria-labelledby="final-cta-title">
        <div class="site-container section-space relative z-10 text-center">
            <h2 id="final-cta-title" class="mx-auto max-w-4xl text-3xl leading-tight sm:text-4xl lg:text-5xl">What’s harder about doing business with you than it needs to be?</h2>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-stone-300">Tell us what frustrates your customers or staff. A Digital Friction Audit is a practical place to begin the conversation.</p>
            <div class="mt-9 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a class="button button-primary" href="{{ route('digital-friction-audit') }}" data-cta-location="final-cta">Request a Digital Friction Audit</a>
                <a class="font-semibold text-local-200 underline decoration-local-500 decoration-2 underline-offset-4 hover:text-white" href="{{ route('contact') }}">Have a question? Contact Local Works</a>
            </div>
        </div>
        <div class="pointer-events-none absolute -bottom-48 left-1/2 size-96 -translate-x-1/2 rounded-full border-[70px] border-local-700/30" aria-hidden="true"></div>
    </section>
@endsection
