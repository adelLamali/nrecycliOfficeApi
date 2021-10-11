@component('mail::message')



<strong style="text-align:center;">{{__('office.ordertitle')}}</strong>     
 
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
    <p style="text-align:center;">
      {{ $quotation['office_name'] }}<br>
      {{ $quotation['phone_number'] }}<br>
      {{ $quotation['address'] }}
    </p>
  </div>
@endcomponent


@endcomponent


