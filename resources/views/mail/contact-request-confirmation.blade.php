<h1>We received your message</h1>

<p>Hello {{ $contactRequest->name }},</p>

<p>Thank you for contacting Local Works. We received your message.</p>

<h2>Your submitted information</h2>
<dl>
    <dt><strong>Name</strong></dt><dd>{{ $contactRequest->name }}</dd>
    <dt><strong>Email</strong></dt><dd>{{ $contactRequest->email }}</dd>
    @if ($contactRequest->phone)<dt><strong>Phone</strong></dt><dd>{{ $contactRequest->phone }}</dd>@endif
    @if ($contactRequest->business_name)<dt><strong>Business / organization</strong></dt><dd>{{ $contactRequest->business_name }}</dd>@endif
    <dt><strong>Message</strong></dt><dd>{!! nl2br(e($contactRequest->message)) !!}</dd>
</dl>

<p>Local Works will review your message and follow up using the contact information you provided.</p>

<p>Local Works</p>
