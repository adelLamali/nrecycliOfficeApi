@component('mail::message')

{{__('office.facture_msg_one')}} {{ $invoice['to_be_delivered_at'] }} {{__('office.facture_msg_two')}} " {{ $invoice['number'] }} " 
{{__('office.facture_msg_three')}}  {{ $invoice['total'] }} DA.<br>
{{__('office.facture_msg_four')}}<br>
{{__('office.facture_msg_five')}}{{__('office.facture_msg_six')}}

@endcomponent
