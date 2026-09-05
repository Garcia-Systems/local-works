@extends('layouts.public')

@section('title', 'How It Works')
@section('meta_description', 'See how Local Works observes, understands, measures, chooses, and delivers practical workflow improvements without assuming custom software is the answer.')

@section('content')
    <x-page-introduction eyebrow="How it works" title="Start with how the work actually gets done.">
        Local Works begins with the current workflow, not a predetermined technology solution. We look at what customers and staff are trying to accomplish, where unnecessary friction appears, and whether changing the process is actually worth it.
        <x-slot:actions>
            <a class="button button-primary" href="{{ route('digital-friction-audit') }}" data-analytics-event="audit_cta_click" data-analytics-location="how_it_works_hero">Request a Digital Friction Audit</a>
            <a class="button button-secondary" href="{{ route('problems') }}">See Problems We Investigate</a>
        </x-slot:actions>
    </x-page-introduction>

    <section class="section-space bg-warm-50" aria-labelledby="basic-idea-title">
        <div class="site-container grid gap-10 lg:grid-cols-[.85fr_1.15fr] lg:gap-20">
            <div>
                <p class="eyebrow mb-4">The basic idea</p>
                <h2 id="basic-idea-title" class="section-heading">The problem comes before the solution.</h2>
            </div>
            <div class="max-w-2xl">
                <p class="body-large">A frustrating process does not automatically mean buying new software, automating everything, building something custom, or replacing existing systems.</p>
                <p class="body-copy mt-5">We first clarify what someone is trying to do, what actually happens today, where effort, delay, or confusion appears, and whether the problem matters enough to justify intervention. Technology is considered later.</p>
            </div>
        </div>
    </section>

    <section class="border-y border-warm-200 bg-white" aria-labelledby="method-overview-title">
        <div class="site-container py-10 sm:py-12">
            <h2 id="method-overview-title" class="sr-only">Local Works methodology overview</h2>
            <x-process-sequence :items="['Observe', 'Understand', 'Measure', 'Choose', 'Deliver']" label="Local Works methodology: Observe, Understand, Measure, Choose, Deliver" />
        </div>
    </section>

    <section class="section-space bg-white" aria-labelledby="observe-title">
        <div class="site-container method-detail">
            <div class="method-detail__intro">
                <span class="method-detail__number" aria-hidden="true">01</span>
                <div><p class="eyebrow mb-3">Observe</p><h2 id="observe-title" class="section-heading">1. Observe</h2></div>
            </div>
            <div>
                <p class="method-question">Where are customers or employees doing unnecessary work?</p>
                <p class="body-copy mt-5">We look at the workflow from the perspective of the people who actually use it. Signals can include unnecessary calls, repeated emails, paper handoffs, waiting for callbacks, entering the same information twice, copying between systems, switching among several tools, avoidable in-person visits, or unclear status after a request.</p>
                <p class="method-note mt-7"><strong>Observation produces questions, not conclusions.</strong> Not every inconvenience is a serious business problem.</p>
            </div>
        </div>
    </section>

    <section class="section-space border-y border-warm-200 bg-warm-100" aria-labelledby="understand-title">
        <div class="site-container method-detail">
            <div class="method-detail__intro">
                <span class="method-detail__number" aria-hidden="true">02</span>
                <div><p class="eyebrow mb-3">Understand</p><h2 id="understand-title" class="section-heading">2. Understand</h2></div>
            </div>
            <div>
                <p class="method-question">How does the process actually work today?</p>
                <p class="body-copy mt-5">The visible customer experience may be only one part of a larger internal process. We map who starts it, what information is needed, which people and systems become involved, where handoffs happen, what happens when something goes wrong, what the customer sees, and what staff do behind the scenes.</p>
                <figure class="example-flow mt-8">
                    <figcaption><span>Illustrative workflow</span> A hypothetical example, not a Local Works customer</figcaption>
                    <ol aria-label="Example current-state workflow">
                        @foreach (['Website inquiry', 'Inbox', 'Phone call', 'Calendar', 'Spreadsheet', 'Payment link'] as $stage)
                            <li>{{ $stage }}</li>
                        @endforeach
                    </ol>
                </figure>
            </div>
        </div>
    </section>

    <section class="section-space bg-local-800 text-white" aria-labelledby="evidence-title">
        <div class="site-container">
            <div class="max-w-3xl">
                <p class="eyebrow mb-4 !text-local-200">Evidence discipline</p>
                <h2 id="evidence-title" class="section-heading">Observation is not proof.</h2>
                <p class="mt-5 text-lg leading-8 text-local-100">A visible inconvenience is a reason to investigate—not a reason to prescribe a solution.</p>
            </div>
            <ol class="evidence-sequence mt-10" aria-label="Evidence sequence from observation to decision">
                @foreach ([
                    ['Observed fact', 'A customer must call to cancel.'],
                    ['Possible friction', 'It may be inconvenient for customers and time-consuming for staff.'],
                    ['Unknowns', 'How often does it happen, and what constraints explain the current process?'],
                    ['Questions', 'How many calls occur, how much staff time is involved, and what do existing systems support?'],
                    ['Evidence', 'Usage, interviews, feedback, workflow data, and existing-system capabilities.'],
                    ['Decision', 'Determine whether anything should change.'],
                ] as [$label, $copy])
                    <li><span>{{ $loop->iteration }}</span><h3>{{ $label }}</h3><p>{{ $copy }}</p></li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="section-space bg-white" aria-labelledby="measure-title">
        <div class="site-container method-detail">
            <div class="method-detail__intro"><span class="method-detail__number" aria-hidden="true">03</span><div><p class="eyebrow mb-3">Measure</p><h2 id="measure-title" class="section-heading">3. Measure</h2></div></div>
            <div>
                <p class="method-question">Is the problem important enough to justify changing?</p>
                <p class="body-copy mt-5">We consider operational burden and economic reality: how often it happens, how many people experience it, employee time, lost inquiries, mistakes, rework, customer impact, the cost of change, and how much burden could realistically be removed.</p>
                <p class="method-note mt-7">Not every problem can—or should—be reduced to a precise dollar value. The purpose is disciplined decision-making, not a promised return.</p>
            </div>
        </div>
    </section>

    <section class="section-space border-y border-warm-200 bg-warm-50" aria-labelledby="choose-title">
        <div class="site-container">
            <div class="max-w-3xl"><p class="eyebrow mb-4">Choose</p><h2 id="choose-title" class="section-heading">4. Choose</h2><p class="method-question mt-5">What is the simplest sensible response?</p><p class="body-copy mt-5">These five outcomes are alternatives, not levels of sophistication. The evidence—not the size of the project—determines the right response.</p></div>
            <div class="outcome-grid mt-12">
                <article><span>01</span><h3>Configure</h3><p>Use existing tools more effectively by enabling features, improving settings, or reorganizing a workflow.</p></article>
                <article><span>02</span><h3>Integrate</h3><p>Connect systems that work individually but require unnecessary manual transfer between them.</p></article>
                <article><span>03</span><h3>Automate</h3><p>Remove repetitive steps when the workflow is understood and stable enough to automate safely.</p></article>
                <article><span>04</span><h3>Custom Build</h3><p>Create software only when the problem is real, existing options fall short, value justifies cost, and ongoing support makes sense.</p></article>
                <article><span>05</span><h3>Leave Alone</h3><p>Keep the process when the issue is small or rare, the workaround is acceptable, constraints make change impractical, or likely benefit does not justify cost.</p></article>
            </div>
        </div>
    </section>

    <section class="section-space bg-white" aria-labelledby="hierarchy-title">
        <div class="site-container grid gap-10 lg:grid-cols-[.75fr_1.25fr] lg:gap-20">
            <div><p class="eyebrow mb-4">A simple solution hierarchy</p><h2 id="hierarchy-title" class="section-heading">Use what already exists before creating something new.</h2><p class="body-copy mt-5">This is an evaluation direction, not a rigid rule. If a focused custom solution is genuinely the best answer, we should be comfortable recommending it.</p></div>
            <ol class="evaluation-list">
                @foreach (['Can the current process simply be improved?', 'Can an existing system be configured?', 'Can existing systems be connected?', 'Can repetitive work be automated?', 'Is custom software actually justified?', 'Is leaving the process alone the better decision?'] as $question)
                    <li><span>{{ $loop->iteration }}</span>{{ $question }}</li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="section-space border-y border-warm-200 bg-local-50" aria-labelledby="deliver-title">
        <div class="site-container method-detail">
            <div class="method-detail__intro"><span class="method-detail__number" aria-hidden="true">05</span><div><p class="eyebrow mb-3">Deliver</p><h2 id="deliver-title" class="section-heading">5. Deliver</h2></div></div>
            <div>
                <p class="method-question">If action is justified, how should the solution get implemented?</p>
                <p class="body-large mt-5">When implementation is justified, Local Works helps determine the right delivery approach and coordinate the technical work.</p>
                <p class="body-copy mt-5">That may mean changes inside an existing system, vendor or SaaS configuration, integration, workflow automation, specialist contractors, an agency, focused custom development, or support for a customer’s internal technical team. The approach depends on the need; it does not imply formal partnerships with every possible resource.</p>
                <p class="method-note mt-7">Responsibility should stay tied to the business outcome—not merely to writing code.</p>
            </div>
        </div>
    </section>

    <section class="py-14 bg-ink text-white sm:py-16" aria-labelledby="assumptions-title">
        <div class="site-container grid gap-8 lg:grid-cols-[.55fr_1.45fr] lg:gap-20">
            <h2 id="assumptions-title" class="text-3xl sm:text-4xl">What we don't assume.</h2>
            <ul class="assumption-list">
                <li>Custom software is necessary.</li><li>Every inconvenience deserves a project.</li><li>The visible symptom is the real problem.</li><li>Replacing existing tools is better.</li><li>Automation is automatically an improvement.</li>
            </ul>
        </div>
    </section>

    <section class="section-space bg-white" aria-labelledby="scenario-title">
        <div class="site-container">
            <div class="max-w-3xl"><p class="eyebrow mb-4">Example scenario</p><h2 id="scenario-title" class="section-heading">A hypothetical appointment request</h2><p class="body-copy mt-5">This example only illustrates the decision process. It is not a customer story or a claimed project outcome.</p></div>
            <figure class="example-flow mt-9">
                <figcaption><span>Current process</span> A service business receives appointment requests through its website.</figcaption>
                <ol aria-label="Hypothetical appointment request workflow">
                    @foreach (['Website form', 'Email inbox', 'Staff callback', 'Calendar', 'Confirmation email'] as $stage)<li>{{ $stage }}</li>@endforeach
                </ol>
            </figure>
            <ol class="scenario-walkthrough mt-12">
                <li><h3>Observe</h3><p>Customers wait for callbacks.</p></li>
                <li><h3>Understand</h3><p>Staff manually move information from the inquiry into the calendar.</p></li>
                <li><h3>Measure</h3><p>Investigate volume, staff time, no-shows, existing software capabilities, and customer impact.</p></li>
                <li><h3>Choose</h3><p>Options might be configuring scheduling features, connecting the website and calendar, automating confirmations, using an existing scheduling product, building only if justified, or leaving it alone if the burden is too small.</p></li>
                <li><h3>Deliver</h3><p>If change is worthwhile, implement and coordinate the selected approach.</p></li>
            </ol>
        </div>
    </section>

    <section class="section-space border-y border-warm-200 bg-warm-100" aria-labelledby="audit-bridge-title">
        <div class="site-container grid gap-12 lg:grid-cols-[.85fr_1.15fr] lg:gap-20">
            <div><p class="eyebrow mb-4">A structured starting point</p><h2 id="audit-bridge-title" class="section-heading">The Digital Friction Audit is where this process begins.</h2><p class="body-copy mt-5">The audit examines relevant parts of a customer or employee journey and identifies where deeper investigation may be worthwhile. It is not an automatic software recommendation engine.</p><a class="button button-primary mt-8" href="{{ route('digital-friction-audit') }}" data-analytics-event="audit_cta_click" data-analytics-location="how_it_works_audit_section">Request a Digital Friction Audit</a></div>
            <div><h3 class="text-lg font-semibold">A typical customer journey</h3><x-process-sequence class="mt-5" :items="['Find', 'Understand', 'Contact', 'Book / Join', 'Pay', 'Receive Service', 'Manage', 'Return']" label="Customer journey examined by a Digital Friction Audit" /><p class="supporting-copy mt-5">The relevant stages vary by business. The audit is a structured place to begin asking questions.</p></div>
        </div>
    </section>

    <section class="relative overflow-hidden bg-local-800 text-white" aria-labelledby="how-final-title">
        <div class="site-container section-space relative z-10 text-center"><h2 id="how-final-title" class="mx-auto max-w-4xl text-3xl leading-tight sm:text-4xl lg:text-5xl">Have a workflow that feels harder than it should?</h2><p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-local-100">Describe the friction. Local Works can help investigate whether it is worth changing and what the simplest practical response might be.</p><div class="mt-9 flex flex-col items-center justify-center gap-4 sm:flex-row"><a class="button button-primary border-white bg-white text-local-800 hover:border-local-100 hover:bg-local-100" href="{{ route('digital-friction-audit') }}" data-analytics-event="audit_cta_click" data-analytics-location="how_it_works_final">Request a Digital Friction Audit</a><a class="font-semibold text-local-100 underline decoration-local-500 decoration-2 underline-offset-4 hover:text-white" href="{{ route('contact') }}">Contact Local Works</a></div></div>
        <div class="pointer-events-none absolute -bottom-48 left-1/2 size-96 -translate-x-1/2 rounded-full border-[70px] border-local-700/40" aria-hidden="true"></div>
    </section>
@endsection
