@component('mail::message')
<!-- # Introduction -->

<div>

    {{ $guest['phone_number'] }}
    {{ $guest['call_scheduled_at'] }}

    Amdjad,"{{ $guest['phone_number'] }}" has scheduled a call at {{ $guest['call_scheduled_at'] }}

</div>

@endcomponent
