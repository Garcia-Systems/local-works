@extends('layouts.public')

@section('title', 'About Local Works | Local Works')
@section('meta_description', 'Learn how Local Works by Garcia Systems investigates business workflows and helps choose the simplest sensible response.')

@section('content')
    <div data-page="about">
        <x-page-introduction eyebrow="About Local Works" title="Better business systems start with better questions.">
            Local Works is the customer-facing business improvement initiative of Garcia Systems. It helps businesses investigate frustrating customer and staff workflows and determine the simplest practical way to improve them.
            <x-slot:actions>
                <a class="button button-primary" href="{{ route('digital-friction-audit') }}" data-cta-location="about-hero" data-analytics-action="about-audit-cta">Request a Digital Friction Audit</a>
                <a class="button button-secondary" href="{{ route('how-it-works') }}">See How It Works</a>
            </x-slot:actions>
        </x-page-introduction>

        <section class="section-space bg-warm-50" aria-labelledby="what-title">
            <div class="site-container grid gap-10 lg:grid-cols-[.8fr_1.2fr] lg:gap-20">
                <div><p class="eyebrow mb-4">What Local Works is</p><h2 id="what-title" class="section-heading">Local Works helps businesses make everyday work easier.</h2></div>
                <div class="max-w-2xl"><p class="body-large">We investigate real workflows to understand what happens today, where customers or staff face unnecessary effort, and whether the problem matters enough to address.</p><p class="body-copy mt-5">Then we help determine the simplest sensible response. If action is justified, Local Works can help define the next step and coordinate implementation. Technology supports that decision; it does not lead it.</p></div>
            </div>
        </section>

        <section class="section-space border-y border-warm-200 bg-white" aria-labelledby="why-title">
            <div class="site-container grid gap-10 lg:grid-cols-[.75fr_1.25fr] lg:gap-20">
                <div><p class="eyebrow mb-4">Why Local Works exists</p><h2 id="why-title" class="section-heading">Too many business problems get translated into software too early.</h2></div>
                <div><p class="body-large">Awkward customer processes, repeated administrative work, disconnected systems, manual handoffs, difficult scheduling or membership changes, unclear follow-up, and duplicate data entry can all deserve investigation.</p><p class="body-copy mt-5">But immediately buying software, replacing systems, automating everything, or commissioning custom development can create more cost and complexity without resolving the underlying problem. Local Works starts by investigating what is happening and why.</p><p class="principle-callout-light mt-8">The goal is not to maximize technology. The goal is to improve the business sensibly.</p></div>
            </div>
        </section>

        <section class="section-space bg-local-800 text-white" aria-labelledby="principle-title">
            <div class="site-container"><div class="max-w-3xl"><p class="eyebrow mb-4 !text-local-200">The Local Works principle</p><h2 id="principle-title" class="section-heading">Use the simplest sensible solution.</h2><p class="mt-5 text-lg leading-8 text-local-100">Each outcome is legitimate. The work is to choose what the evidence and economics support—not to move every problem toward a build.</p></div>
                <ul class="decision-grid mt-12" aria-label="Possible Local Works outcomes">
                    @foreach ([['Configure', 'Use what already exists more effectively before replacing it.'], ['Integrate', 'Connect existing systems before creating duplicate ones.'], ['Automate', 'Automate only after the workflow is understood.'], ['Custom Build', 'Develop something new only when the need and economics justify it.'], ['Leave Alone', 'Make no change when intervention does not make operational or economic sense.']] as [$decision, $copy])
                        <li><span aria-hidden="true">{{ $loop->iteration }}</span><h3>{{ $decision }}</h3><p>{{ $copy }}</p></li>
                    @endforeach
                </ul>
                <a class="content-link mt-7 inline-block !text-local-200 hover:!text-white" href="{{ route('how-it-works') }}">Explore the full methodology</a>
            </div>
        </section>

        <section class="section-space bg-local-50" aria-labelledby="relationship-title">
            <div class="site-container grid gap-10 lg:grid-cols-[.7fr_1.3fr] lg:gap-20"><div><p class="text-xl font-extrabold tracking-[.16em] text-ink">LOCAL WORKS</p><p class="mt-2 text-sm text-muted">by Garcia Systems</p></div><div class="max-w-3xl"><h2 id="relationship-title" class="section-heading">Local Works by Garcia Systems</h2><p class="body-large mt-6">Garcia Systems is the parent, legal, and professional company behind Local Works. Local Works is its customer-facing service initiative focused on practical workflow improvement.</p><p class="body-copy mt-5">Garcia Systems provides the technical foundation and professional identity. Local Works keeps the public conversation centered on business problems, everyday work, and useful outcomes rather than technology stacks.</p></div></div>
        </section>

        <section class="section-space border-y border-warm-200 bg-white" aria-labelledby="delivery-title">
            <div class="site-container grid gap-10 lg:grid-cols-[.85fr_1.15fr] lg:gap-20"><div><p class="eyebrow mb-4">Implementation responsibility</p><h2 id="delivery-title" class="section-heading">If action is justified, the delivery approach depends on the problem.</h2><p class="body-copy mt-5">Local Works helps determine the right delivery approach and coordinate the technical work.</p></div><div><ul class="two-column-list" aria-label="Possible implementation approaches">@foreach (['Configure existing systems', 'Work with an existing software vendor', 'Connect existing systems', 'Automate repetitive workflow steps', 'Engage specialist contractors', 'Work with an agency', 'Undertake focused custom development', 'Support a customer’s internal technical team'] as $item)<li>{{ $item }}</li>@endforeach</ul><p class="supporting-copy mt-5">These are possible approaches, not claims of formal partnerships. The appropriate participants are determined only after the problem is understood.</p></div></div>
        </section>

        <section class="section-space bg-warm-100" aria-labelledby="not-title">
            <div class="site-container grid gap-10 lg:grid-cols-[.7fr_1.3fr] lg:gap-20"><div><p class="eyebrow mb-4">Clear boundaries</p><h2 id="not-title" class="section-heading">What Local Works is not.</h2></div><ul class="lined-list" aria-label="What Local Works is not">@foreach (['Not a software-first sales process.', 'Not a promise that every workflow should be automated.', 'Not a replacement project looking for a reason to happen.', 'Not an AI product disguised as consulting.', 'Not a custom-development recommendation engine.', 'Not a guarantee that every inconvenience deserves investment.'] as $item)<li>{{ $item }}</li>@endforeach</ul></div>
        </section>

        <section class="section-space bg-white" aria-labelledby="proof-standard-title">
            <div class="site-container grid gap-10 lg:grid-cols-[.85fr_1.15fr] lg:gap-20"><div><p class="eyebrow mb-4">A standard for evidence</p><h2 id="proof-standard-title" class="section-heading">Proof should come from real work.</h2><p class="body-copy mt-5">Customer outcomes belong here only when the customer is real, permission is obtained, results are measured appropriately, attribution is accurate, and confidentiality is respected.</p></div><div class="surface-card"><h3 class="text-xl">Until evidence meets that standard</h3><p class="body-copy mt-4">Local Works explains its thinking through methodology, clearly labeled examples and hypothetical scenarios, public observations, and educational content. None are presented as customer results.</p></div></div>
        </section>

        <section class="section-space border-y border-warm-200 bg-local-50" aria-labelledby="start-title">
            <div class="site-container"><div class="max-w-3xl"><p class="eyebrow mb-4">Disciplined growth</p><h2 id="start-title" class="section-heading">Start small. Learn from real work.</h2><p class="body-copy mt-5">Local Works is intentionally beginning with a focused website, real Digital Friction Audits, and real conversations before larger internal systems are considered. Operating evidence—not imagined scale—should guide what comes next.</p></div><x-process-sequence class="mt-10" :items="['Small credible website', 'Real Digital Friction Audits', 'Real conversations', 'First proposal', 'First customer', 'Learn from real operations']" label="Local Works evidence-led progression" /></div>
        </section>

        <section class="bg-ink text-white" aria-labelledby="about-final-title"><div class="site-container section-space text-center"><h2 id="about-final-title" class="mx-auto max-w-3xl text-3xl leading-tight sm:text-4xl lg:text-5xl">Have a workflow that deserves a closer look?</h2><p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-stone-300">Start with an audit, or send a general question if you are not sure which path fits.</p><div class="mt-9 flex flex-col items-center justify-center gap-4 sm:flex-row"><a class="button button-primary" href="{{ route('digital-friction-audit') }}" data-cta-location="about-final" data-analytics-action="about-audit-cta">Request a Digital Friction Audit</a><a class="button button-secondary" href="{{ route('contact') }}">Contact Local Works</a></div></div></section>
    </div>
@endsection
