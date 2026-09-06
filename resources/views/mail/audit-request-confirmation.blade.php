<h1>We received your Digital Friction Audit request</h1>

<p>Hello {{ $auditRequest->name }},</p>

<p>Thank you for contacting Local Works. We received your Digital Friction Audit request.</p>

<h2>Your submitted information</h2>
<dl>
    <dt><strong>Name</strong></dt><dd>{{ $auditRequest->name }}</dd>
    <dt><strong>Email</strong></dt><dd>{{ $auditRequest->email }}</dd>
    @if ($auditRequest->phone)<dt><strong>Phone</strong></dt><dd>{{ $auditRequest->phone }}</dd>@endif
    <dt><strong>Business</strong></dt><dd>{{ $auditRequest->business_name }}</dd>
    @if ($auditRequest->business_website)<dt><strong>Website</strong></dt><dd>{{ $auditRequest->business_website }}</dd>@endif
    @if ($auditRequest->business_type)<dt><strong>Business type</strong></dt><dd>{{ $auditRequest->business_type }}</dd>@endif
    @if ($auditRequest->business_location)<dt><strong>Location</strong></dt><dd>{{ $auditRequest->business_location }}</dd>@endif
    <dt><strong>Friction described</strong></dt><dd>{!! nl2br(e($auditRequest->friction_description)) !!}</dd>
    <dt><strong>Current process</strong></dt><dd>{!! nl2br(e($auditRequest->current_process)) !!}</dd>
    @if ($auditRequest->desired_improvement)<dt><strong>Desired improvement</strong></dt><dd>{!! nl2br(e($auditRequest->desired_improvement)) !!}</dd>@endif
    @if ($auditRequest->additional_context)<dt><strong>Additional context</strong></dt><dd>{!! nl2br(e($auditRequest->additional_context)) !!}</dd>@endif
</dl>

<p>Local Works will review your request and follow up using the contact information you provided.</p>

<p>Local Works</p>
