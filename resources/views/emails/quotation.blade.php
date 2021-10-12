@component('mail::message')

<div>
  <p style="text-align:center;">
    {{__('office.welcome')}} <strong style="color:#69bf37">{{ $quotation['office_name'] }}</strong> {{__('office.first_msg')}}<br>
    {{__('office.second_msg')}}<br>
    {{__('office.third_msg')}}{{__('office.fourth_msg')}} <strong style="color:#69bf37">« NRECYCLI OFFICE »</strong> {{__('office.fifth_msg')}}<br>
    {{__('office.sixth_msg')}}
  </p>
</div>

<p style="text-align:center;">
  <strong>{{__('office.ordertitle')}}</strong>
</p>   
 
@component('mail::table')
| {{__('office.item')}}          | {{__('office.uniteprice')}}    | {{__('office.count')}}     | {{__('office.total')}}    |
| ------------- |:------------- |:------------- | :-------- | :--------|
|  {{__('office.workshop')}}      |25.000 {{__('office.da')}}| x {{$quotation['order']['workshop']}}      | {{ ( $quotation['order']['workshop'] / 10 ) * 25000 }} {{__('office.da')}} |
|  {{__('office.twostreams')}}    |23.800 {{__('office.da')}}| x {{$quotation['order']['threeFlowBins']}}   | {{ $quotation['order']['threeFlowBins'] * 23800 }} {{__('office.da')}} |
|  {{__('office.threestreams')}}   |29.700 {{__('office.da')}}| x {{$quotation['order']['twoFlowBins']}} | {{ $quotation['order']['twoFlowBins'] * 29700 }} {{__('office.da')}} |
|  {{__('office.cardboardbinpet')}}   |1.850 {{__('office.da')}}| x {{$quotation['order']['cardboardBinPet']}} | {{ $quotation['order']['cardboardBinPet'] * 1850 }} {{__('office.da')}} |
|  {{__('office.cardboardbinrp')}}   |1.850 {{__('office.da')}}| x {{$quotation['order']['cardboardBinRp']}} | {{ $quotation['order']['cardboardBinRp'] * 1850 }} {{__('office.da')}} |
|  {{__('office.cardboardbinpaper')}}   |1.850 {{__('office.da')}}| x {{$quotation['order']['cardboardBinAluminium']}} | {{ $quotation['order']['cardboardBinAluminium'] * 1850 }} {{__('office.da')}} |
|  {{__('office.cardboardbinaluminium')}}   |1.850 {{__('office.da')}}| x {{$quotation['order']['cardboardBinPaper']}} | {{ $quotation['order']['cardboardBinPaper'] * 1850 }} {{__('office.da')}} |
|  {{__('office.nrecyclibags')}} 						     				|960 {{__('office.da')}}| x {{$quotation['order']['bags']}}          | {{$quotation['order']['bags'] * 960}} {{__('office.da')}} |
|  {{__('office.collectcontribution')}} |56.400 {{__('office.da')}}/ANS | x {{$quotation['order']['collectContribution']}}      | {{$quotation['order']['collectContribution'] * 56.400}} {{__('office.da')}} / Ans |
|  {{__('office.nrecycliecotracker')}}     							|0 {{__('office.da')}}| x {{$quotation['order']['ecotracker']}}    | 0 {{__('office.da')}}|

@endcomponent
@component('mail::table')
|                |                |
| :------------- |-------------:  |
| {{__('office.tva') }}   | {{ $quotation['tva'] }} {{__('office.da')}} |
| {{__('office.totalht')}}    | {{ $quotation['totalht'] }} {{__('office.da')}} |
| {{__('office.total')}}    | {{ $quotation['total'] }} {{__('office.da')}}|

@endcomponent

@component('mail::subcopy')
  <div >
    <p style="text-align:left;">
      {{__('office.seventh_msg')}}<strong style="color:#41E2F8">{{__('office.eigth_msg')}}</strong><br>
      {{__('office.ninth_msg')}}<br>
      {{__('office.tenth_msg')}}<strong style="color:#41E2F8">office.nrecycli.com</strong><br>
      {{__('office.eleventh_msg')}}
    </p>
  </div>
@endcomponent


@endcomponent


