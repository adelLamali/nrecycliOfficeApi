@component('mail::message')
<!-- # Introduction -->


<div style="display:flex;align-items:center;justify-content:center;margin-bottom:4rem;">
    <img 
        src="https://office.nrecycli.com/svg/reset_password.svg" 
        style="border-radius:100%" 
        width="130" 
        height="130" 
        alt="nrecycli"
    >
</div>

<div>
    <p style="text-align:center;font-weight: bold;">
        {{__('office.reset_password')}}
    </p>
</div>

<div style="margin-bottom:4rem;">
    <p style="text-align:center;">
        {{__('office.reset_password_message')}}
    </p>
</div>


@component('mail::button', ['url' => 'https://office.nrecycli.com/forgotpassword?q=' . $user->token ])
{{__('office.login')}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
