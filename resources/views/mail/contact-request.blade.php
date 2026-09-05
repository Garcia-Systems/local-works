<h1>New Local Works Contact Request</h1>

<dl>
    <dt><strong>Name</strong></dt><dd>{{ $contactRequest->name }}</dd>
    <dt><strong>Email</strong></dt><dd>{{ $contactRequest->email }}</dd>
    @if ($contactRequest->phone)<dt><strong>Phone</strong></dt><dd>{{ $contactRequest->phone }}</dd>@endif
    @if ($contactRequest->business_name)<dt><strong>Business / organization</strong></dt><dd>{{ $contactRequest->business_name }}</dd>@endif
    <dt><strong>Message</strong></dt><dd>{!! nl2br(e($contactRequest->message)) !!}</dd>
</dl>

<h2>First-touch attribution</h2>
<dl>
    @foreach (['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'referrer', 'landing_page'] as $field)
        <dt><strong>{{ str($field)->replace('_', ' ')->title() }}</strong></dt><dd>{{ $contactRequest->{$field} ?: 'Not captured' }}</dd>
    @endforeach
    <dt><strong>Submitted</strong></dt><dd>{{ $contactRequest->created_at->toDayDateTimeString() }} UTC</dd>
</dl>
