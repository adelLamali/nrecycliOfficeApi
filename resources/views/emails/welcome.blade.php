@component('mail::message')

<div style="display:flex;align-items:center;justify-content:center;">
<img
    src="https://office.nrecycli.com/svg/congratulations.svg" 
    style="border-radius:100%;margin-bottom:2rem;"
    width="130" 
    height="130" 
    alt="nrecycli"
>
</div>

<p style="text-align:center;font-weight: bold;">
    Congratulations!
</p>
<p style="text-align:center;">
    Nous vous félicitons d'avoir rejoint notre communauté d'entreprises écoresponsables.
</p>

<p style="text-align:center;">
    Vous pouvez des maintenant consulter votre calendrier de collectes et vos indicateurs 
    d'impact environnemental 
    en vous connectant a votre espace client 
    <strong> office.nrecycli.com </strong>
    ou en cliquant
</p>

@component('mail::button', ['url' => 'https://office.nrecycli.com/welcome?q=' . $user->token ])
    {{__('office.login')}}
@endcomponent

@endcomponent
