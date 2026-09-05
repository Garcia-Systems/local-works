@extends('layouts.public')

@section('title', 'Digital Friction Audit | Local Works')
@section('meta_description', 'Local Works investigates unnecessary customer and staff workflow friction, then identifies the questions and evidence needed before recommending change.')

@section('content')
    <div data-page="digital-friction-audit" data-analytics-page="audit">
        <x-page-introduction eyebrow="Digital Friction Audit" title="Find what is harder than it needs to be.">
            Local Works examines how customers and employees move through important business processes, identifies possible friction, and determines what questions need to be answered before recommending change.
            <x-slot:actions>
                <a class="button button-primary" href="#audit-intake" data-cta-location="audit-hero">Request a Digital Friction Audit</a>
                <a class="button button-secondary" href="{{ route('how-it-works') }}">See How It Works</a>
            </x-slot:actions>
        </x-page-introduction>

        <section class="section-space bg-warm-100" aria-labelledby="friction-title">
            <div class="site-container grid gap-10 lg:grid-cols-[.8fr_1.2fr] lg:gap-20">
                <div>
                    <p class="eyebrow mb-4">Start with the workflow, not the software</p>
                    <h2 id="friction-title" class="section-heading">Digital friction is unnecessary effort in getting something done.</h2>
                    <p class="body-copy mt-5">Manual work can be entirely appropriate. The question is whether the effort is necessary for the business need—not whether every human step can be removed.</p>
                </div>
                <ul class="friction-signals" aria-label="Ways digital friction may appear">
                    @foreach (['Call when reasonable self-service could exist', 'Send repeated emails or wait for callbacks', 'Print or scan documents', 'Repeat information or copy it between systems', 'Switch between disconnected tools', 'Visit physically when the task could reasonably be handled another way', 'Perform repetitive administrative work', 'Wonder what happens after submitting a request'] as $signal)
                        <li>{{ $signal }}</li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="section-space bg-white" aria-labelledby="journey-title">
            <div class="site-container">
                <div class="max-w-3xl"><p class="eyebrow mb-4">Customer journey lens</p><h2 id="journey-title" class="section-heading">Follow the work from beginning to end.</h2><p class="body-copy mt-5">The audit looks at the relevant parts of the journey, including what the customer sees and what must happen behind the scenes.</p></div>
                <ol class="journey-map mt-10" aria-label="Customer journey stages">
                    @foreach ([
                        ['Find', 'Can someone locate the business and the relevant service or information?'],
                        ['Understand', 'Can they understand what is offered, what it costs and what they need to do?'],
                        ['Contact', 'Can they ask a question or start the process easily?'],
                        ['Book / Join', 'Can they schedule, register, reserve or become a member without unnecessary steps?'],
                        ['Pay', 'Is payment clear and appropriately connected to the process?'],
                        ['Receive Service', 'Does the customer understand what happens next?'],
                        ['Manage', 'Can customers make reasonable changes, updates, pauses or cancellations?'],
                        ['Return', 'Is it easy to come back, repeat the process or continue the relationship?'],
                    ] as [$stage, $question])
                        <li><span aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><div><h3>{{ $stage }}</h3><p>{{ $question }}</p></div></li>
                    @endforeach
                </ol>
                <p class="method-note mt-8 max-w-3xl"><strong class="text-ink">Not every business uses every stage.</strong> The audit examines only the parts that are relevant to the business.</p>
            </div>
        </section>

        <section class="section-space border-y border-warm-200 bg-local-50" aria-labelledby="employee-title">
            <div class="site-container grid gap-10 lg:grid-cols-[.9fr_1.1fr] lg:gap-20">
                <div><p class="eyebrow mb-4">Behind the customer experience</p><h2 id="employee-title" class="section-heading">The customer experience often depends on work happening behind the scenes.</h2><p class="body-copy mt-5">The goal is not to eliminate human involvement. It is to understand where people spend time on work that may not require human judgment.</p></div>
                <ul class="two-column-list">
                    @foreach (['Repeated data entry', 'Spreadsheets used to bridge systems', 'Copy and paste between tools', 'Manual status updates', 'Staff answering the same questions repeatedly', 'Unclear ownership between departments', 'Handoffs that depend on memory', 'Information stored in multiple places', 'Manual reconciliation', 'Workarounds because systems do not connect'] as $item)<li>{{ $item }}</li>@endforeach
                </ul>
            </div>
        </section>

        <section class="section-space bg-local-800 text-white" aria-labelledby="proof-title">
            <div class="site-container">
                <div class="max-w-3xl"><p class="eyebrow mb-4 !text-local-200">Evidence discipline</p><h2 id="proof-title" class="section-heading">Seeing friction is only the beginning.</h2><p class="mt-5 text-lg leading-8 text-local-100">A visible inconvenience is a reason to investigate, not proof that a change is worthwhile.</p></div>
                <ol class="evidence-sequence mt-10" aria-label="Observed fact to evidence-based decision">
                    @foreach ([['Observed fact', 'Record what can actually be seen.'], ['Possible friction', 'Describe the effort it may create.'], ['Unknowns', 'Name what is not yet known.'], ['Questions', 'Ask what would test the concern.'], ['Evidence', 'Collect information that answers those questions.'], ['Decision', 'Choose what, if anything, should happen.']] as [$label, $copy])
                        <li><span>{{ $loop->iteration }}</span><h3>{{ $label }}</h3><p>{{ $copy }}</p></li>
                    @endforeach
                </ol>
                <aside class="audit-example mt-10" aria-labelledby="audit-example-title">
                    <p class="eyebrow !text-local-200">Example</p><h3 id="audit-example-title">A hypothetical membership-pause workflow</h3>
                    <dl><div><dt>Observed fact</dt><dd>A gym requires members to call during staffed hours to pause a membership.</dd></div><div><dt>Possible friction</dt><dd>Members may find the process inconvenient, and staff may spend time handling routine account changes.</dd></div></dl>
                    <div class="mt-6"><h4>Unknowns</h4><ul class="mt-3 grid gap-2 text-sm leading-6 text-local-100 sm:grid-cols-2"><li>How often do pause requests occur?</li><li>Why is the process designed this way?</li><li>Does the membership system support self-service?</li><li>Are contractual or business rules involved?</li><li>Does the phone process prevent meaningful errors or abuse?</li></ul></div>
                    <p class="mt-6 font-semibold">Questions and evidence come before recommending a change.</p>
                </aside>
            </div>
        </section>

        <section class="section-space bg-white" aria-labelledby="signals-title">
            <div class="site-container"><div class="max-w-3xl"><p class="eyebrow mb-4">Investigation signals</p><h2 id="signals-title" class="section-heading">What the audit looks for.</h2><p class="body-copy mt-5">These conditions may point to useful questions. Their presence does not mean they all must be fixed.</p></div>
                <div class="signal-groups mt-10">
                    @foreach ([
                        ['Unnecessary communication', ['Repeated calls or email', 'Status-chasing', 'Questions the process should answer']],
                        ['Duplicate work', ['Entering data more than once', 'Copying between systems', 'Maintaining parallel records']],
                        ['Waiting and handoffs', ['Callbacks and approvals', 'Unclear ownership', 'Work sitting in inboxes']],
                        ['Disconnected tools', ['Manual transfer between systems', 'Spreadsheets used as bridges', 'Isolated payment, scheduling or intake']],
                        ['Missing self-service', ['Common account changes', 'Scheduling or registration', 'Information updates and routine requests']],
                        ['Process ambiguity', ['Customers do not know what happens next', 'Employees follow different processes', 'Status is unclear']],
                    ] as [$title, $items])
                        <article><h3>{{ $title }}</h3><ul>@foreach ($items as $item)<li>{{ $item }}</li>@endforeach</ul></article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section-space border-y border-warm-200 bg-warm-100" aria-labelledby="assume-title">
            <div class="site-container">
                <div class="grid gap-10 lg:grid-cols-[.8fr_1.2fr] lg:gap-20"><div><p class="eyebrow mb-4">No predetermined answer</p><h2 id="assume-title" class="section-heading">The audit does not begin with a product to sell.</h2></div><ul class="plain-check-list"><li>It does not assume new software is necessary.</li><li>It does not assume automation is better.</li><li>It does not assume the current system should be replaced.</li><li>It does not assume a visible inconvenience is economically important.</li><li>It does not assume custom development is the destination.</li></ul></div>
                <div class="outcome-grid mt-12" aria-label="Alternative audit outcomes">
                    @foreach ([['Configure', 'Use an existing tool more effectively.'], ['Integrate', 'Connect tools where it makes sense.'], ['Automate', 'Remove justified repetitive steps.'], ['Custom Build', 'Create only what evidence supports.'], ['Leave Alone', 'Keep the process when change is not justified.']] as [$outcome, $copy])<article><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $outcome }}</h3><p>{{ $copy }}</p></article>@endforeach
                </div><p class="supporting-copy mt-5">These are alternative outcomes—not steps in a path toward custom software.</p>
            </div>
        </section>

        <section class="section-space bg-white" aria-labelledby="finding-title">
            <div class="site-container grid gap-10 lg:grid-cols-[.72fr_1.28fr] lg:gap-20"><div><p class="eyebrow mb-4">After a finding</p><h2 id="finding-title" class="section-heading">A finding leads to questions, not immediately to a project.</h2><p class="body-copy mt-5">The full method turns observations into a grounded decision.</p><a class="content-link mt-6 inline-block" href="{{ route('how-it-works') }}">See the Local Works methodology</a></div><x-process-sequence :items="['Possible friction', 'Understand the current workflow', 'Collect evidence', 'Estimate the burden', 'Review existing capabilities and options', 'Compare the cost of change with the value of improvement', 'Decide what, if anything, should happen']" label="Progression from possible friction to a decision" /></div>
        </section>

        <section class="section-space border-y border-warm-200 bg-local-50" aria-labelledby="who-title">
            <div class="site-container grid gap-10 lg:grid-cols-[.85fr_1.15fr] lg:gap-20"><div><p class="eyebrow mb-4">Where the method may help</p><h2 id="who-title" class="section-heading">Repeatable workflows appear in many kinds of organizations.</h2><p class="body-copy mt-5"><strong class="text-ink">The method can be useful anywhere customers or staff move through repeatable workflows.</strong> These are examples of settings where the questions may be relevant—not claims of industry specialization or existing clients.</p></div><ul class="tag-list" aria-label="Example organization types">@foreach (['Gyms and fitness businesses', 'Restaurants', 'Membership businesses', 'Music and dance studios', 'Local service businesses', 'Appointment-based businesses', 'Attractions and recreation businesses', 'Trades', 'Professional services', 'Community organizations'] as $type)<li>{{ $type }}</li>@endforeach</ul></div>
        </section>

        <section class="section-space bg-white" aria-labelledby="examples-title">
            <div class="site-container"><div class="max-w-3xl"><p class="eyebrow mb-4">Hypothetical examples</p><h2 id="examples-title" class="section-heading">Examples of friction we might investigate.</h2><p class="body-copy mt-5">These are illustrations only. They are not Local Works customer stories or claimed results.</p></div>
                <div class="example-list mt-10">@foreach ([['Membership change', 'Joining happens online, but changing billing information, pausing or canceling requires a call or visit.'], ['Appointment request', 'Website form → inbox → staff callback → calendar → confirmation email.'], ['Event inquiry', 'Social message → email → phone call → separate payment link.'], ['Customer intake', 'An employee manually re-enters information from an online form into another system.'], ['Staff handoff', 'One team records information in one system while another maintains a second copy elsewhere.']] as [$title, $copy])<article><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>@endforeach</div>
            </div>
        </section>

        <section id="audit-intake" class="audit-intake scroll-mt-24" aria-labelledby="intake-title" tabindex="-1">
            <div class="site-container section-space">
                <div class="max-w-3xl"><p class="eyebrow mb-4">Request an audit</p><h2 id="intake-title" class="section-heading">You don't need to diagnose the problem yourself.</h2><p class="body-large mt-5">Provide enough context to begin a useful conversation. Questions about costs, volume, systems, or technical requirements belong in discovery if they become relevant.</p></div>
                <div class="mt-12 grid items-start gap-10 lg:grid-cols-[1.25fr_.75fr] lg:gap-12">
                    <div class="audit-form-surface">
                        @if ($errors->any())
                            <div id="form-errors" class="form-error-summary" role="alert" tabindex="-1" data-validation-errors><strong>Please review the highlighted fields.</strong><span>Your request has not been submitted yet.</span></div>
                        @endif
                        <form class="audit-form mt-8" action="{{ route('audit-requests.store') }}" method="POST" aria-describedby="privacy-note{{ $errors->any() ? ' form-errors' : '' }}" data-audit-intake data-analytics-form="audit-request">
                            @csrf
                            <div class="honeypot" aria-hidden="true"><label for="company_fax">Leave this field empty</label><input id="company_fax" name="company_fax" type="text" tabindex="-1" autocomplete="off"></div>
                            <fieldset><legend>Contact</legend><p class="form-group-help">How we can identify and eventually reply to you.</p><div class="form-grid mt-6">
                                <div class="field sm:col-span-2"><label for="name">Name <span aria-hidden="true">*</span><span class="sr-only"> (required)</span></label><input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required aria-required="true" aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}" aria-describedby="name-help{{ $errors->has('name') ? ' name-error' : '' }}" @if($errors->has('name')) autofocus @endif><p id="name-help">Your full name.</p>@error('name')<p id="name-error" class="field-error">{{ $message }}</p>@enderror</div>
                                <div class="field"><label for="email">Email <span aria-hidden="true">*</span><span class="sr-only"> (required)</span></label><input id="email" name="email" type="email" value="{{ old('email') }}" inputmode="email" autocomplete="email" required aria-required="true" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" aria-describedby="email-help{{ $errors->has('email') ? ' email-error' : '' }}"><p id="email-help">A work or personal email you check.</p>@error('email')<p id="email-error" class="field-error">{{ $message }}</p>@enderror</div>
                                <div class="field"><label for="phone">Phone <span class="field-status">Optional</span></label><input id="phone" name="phone" type="tel" value="{{ old('phone') }}" inputmode="tel" autocomplete="tel" aria-describedby="phone-help"><p id="phone-help">Include it only if a call is convenient.</p></div>
                            </div></fieldset>
                            <fieldset><legend>Business</legend><p class="form-group-help">A little context about the organization and its setting.</p><div class="form-grid mt-6">
                                <div class="field sm:col-span-2"><label for="business_name">Business name <span aria-hidden="true">*</span><span class="sr-only"> (required)</span></label><input id="business_name" name="business_name" type="text" value="{{ old('business_name') }}" autocomplete="organization" required aria-required="true" aria-invalid="{{ $errors->has('business_name') ? 'true' : 'false' }}" aria-describedby="business-name-help{{ $errors->has('business_name') ? ' business-name-error' : '' }}"><p id="business-name-help">The organization connected to the workflow.</p>@error('business_name')<p id="business-name-error" class="field-error">{{ $message }}</p>@enderror</div>
                                <div class="field"><label for="business_website">Business website <span class="field-status">Optional</span></label><input id="business_website" name="business_website" type="text" value="{{ old('business_website') }}" inputmode="url" autocomplete="url" aria-describedby="website-help{{ $errors->has('business_website') ? ' website-error' : '' }}"><p id="website-help">A public URL, with or without https://.</p>@error('business_website')<p id="website-error" class="field-error">{{ $message }}</p>@enderror</div>
                                <div class="field"><label for="business_type">Type of business <span class="field-status">Optional</span></label><input id="business_type" name="business_type" type="text" value="{{ old('business_type') }}" autocomplete="organization-title" aria-describedby="type-help"><p id="type-help">For example, membership or local service business.</p></div>
                                <div class="field sm:col-span-2"><label for="business_location">Location <span class="field-status">Optional</span></label><input id="business_location" name="business_location" type="text" value="{{ old('business_location') }}" autocomplete="address-level2" aria-describedby="location-help"><p id="location-help">City or service area is enough.</p></div>
                            </div></fieldset>
                            <fieldset><legend>Workflow</legend><p class="form-group-help">Plain language is best. You do not need to propose a solution.</p><div class="form-grid mt-6">
                                <div class="field sm:col-span-2"><label for="friction_description">What are customers or employees having trouble doing? <span aria-hidden="true">*</span><span class="sr-only"> (required)</span></label><textarea id="friction_description" name="friction_description" rows="5" required aria-required="true" aria-invalid="{{ $errors->has('friction_description') ? 'true' : 'false' }}" aria-describedby="friction-help{{ $errors->has('friction_description') ? ' friction-error' : '' }}">{{ old('friction_description') }}</textarea><p id="friction-help">Describe the task or moment that feels harder than it should.</p>@error('friction_description')<p id="friction-error" class="field-error">{{ $message }}</p>@enderror</div>
                                <div class="field sm:col-span-2"><label for="current_process">How is that process handled today? <span aria-hidden="true">*</span><span class="sr-only"> (required)</span></label><textarea id="current_process" name="current_process" rows="5" required aria-required="true" aria-invalid="{{ $errors->has('current_process') ? 'true' : 'false' }}" aria-describedby="process-help{{ $errors->has('current_process') ? ' process-error' : '' }}">{{ old('current_process') }}</textarea><p id="process-help">Tell us the main steps, people, or tools involved as best you know them.</p>@error('current_process')<p id="process-error" class="field-error">{{ $message }}</p>@enderror</div>
                                <div class="field sm:col-span-2"><label for="desired_improvement">What would you like to improve? <span class="field-status">Optional</span></label><textarea id="desired_improvement" name="desired_improvement" rows="4" aria-describedby="improvement-help">{{ old('desired_improvement') }}</textarea><p id="improvement-help">Focus on the experience or burden, not a particular technology.</p></div>
                                <div class="field sm:col-span-2"><label for="additional_context">Anything else we should know? <span class="field-status">Optional</span></label><textarea id="additional_context" name="additional_context" rows="4" aria-describedby="context-help">{{ old('additional_context') }}</textarea><p id="context-help">Add relevant context only. Detailed system access is not needed.</p></div>
                            </div></fieldset>
                            <p id="privacy-note" class="privacy-note">Information will be used only to evaluate and respond to your request. Do not include passwords or highly sensitive information. Detailed system access is not required at this stage. Read the <a href="{{ route('privacy') }}">privacy notice</a>.</p>
                            <button class="button button-primary w-full sm:w-auto" type="submit" data-analytics-submit="audit-request">Request a Digital Friction Audit</button>
                        </form>
                    </div>
                    <aside aria-labelledby="next-title"><p class="eyebrow mb-4">After a request</p><h2 id="next-title" class="text-3xl">What happens next?</h2><ol class="next-steps mt-7"><li><h3>Local Works reviews the request</h3><p>We look at the business context and the workflow described.</p></li><li><h3>We decide whether a conversation makes sense</h3><p>Not every request will necessarily require a project.</p></li><li><h3>If appropriate, we follow up</h3><p>The next step may be a short conversation to understand the current process.</p></li><li><h3>We investigate before recommending</h3><p>The goal is to understand the problem before discussing implementation.</p></li></ol><p class="supporting-copy mt-7">A request does not automatically create a customer relationship or promise a full consulting engagement.</p></aside>
                </div>
            </div>
        </section>

        <section class="bg-ink text-white" aria-labelledby="final-trust-title"><div class="site-container section-space text-center"><h2 id="final-trust-title" class="mx-auto max-w-4xl text-3xl leading-tight sm:text-4xl lg:text-5xl">You bring the frustrating workflow. We'll start with the questions.</h2><p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-stone-300">You do not need to know whether the answer is configuration, integration, automation, custom software or no change at all. That is what the investigation is for.</p><a class="button button-secondary mt-8" href="#audit-intake">Review the audit intake</a></div></section>
    </div>
@endsection
