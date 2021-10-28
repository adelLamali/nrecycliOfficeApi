@component('mail::message')
<!-- # Introduction -->

<div>

    {{ $account['user']['phone_number'] }}
    {{ $account['user']['email'] }}
    {{ $account['profile']['address'] }}

    Amdjad,"{{ $account['profile']['office_name'] }}" has scheduled a call at {{ $account['call_scheduled_at'] }}

</div>

@endcomponent
