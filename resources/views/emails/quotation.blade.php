@component('mail::message')

<div>
  <p style="text-align:center;">
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
@if($quotation['workshop_price'])
|  {{__('office.workshop')}}      |{{$quotation['workshop_price'] }} {{__('office.da')}}| x 1     | {{ $quotation['workshop_price'] }} {{__('office.da')}} |
@endif
@if($quotation['order']['twoFlowBins'])
|  {{__('office.twostreams')}}    |29.800 {{__('office.da')}}| x {{$quotation['order']['twoFlowBins']}}   | {{ $quotation['order']['twoFlowBins'] * 29800 }} {{__('office.da')}} |
@endif
@if($quotation['order']['threeFlowBins'])
|  {{__('office.threestreams')}}   |45.300 {{__('office.da')}}| x {{$quotation['order']['threeFlowBins']}} | {{ $quotation['order']['threeFlowBins'] * 45300 }} {{__('office.da')}} |
@endif
@if($quotation['order']['indoorLooperPet'])
|  {{__('office.indoorlooperpet')}}   |1000 {{__('office.da')}}| x {{$quotation['order']['indoorLooperPet']}} | {{ $quotation['order']['indoorLooperPet'] * 1000 }} {{__('office.da')}} |
@endif
@if($quotation['order']['indoorLooperRp'])
|  {{__('office.indoorlooperrp')}}   |1000 {{__('office.da')}}| x {{$quotation['order']['indoorLooperRp']}} | {{ $quotation['order']['indoorLooperRp'] * 1000 }} {{__('office.da')}} |
@endif
@if($quotation['order']['indoorLooperPaper'])
|  {{__('office.indoorlooperpaper')}}   |1000 {{__('office.da')}}| x {{$quotation['order']['indoorLooperPaper']}} | {{ $quotation['order']['indoorLooperPaper'] * 1000 }} {{__('office.da')}} |
@endif
@if($quotation['order']['indoorLooperAluminium'])
|  {{__('office.indoorlooperaluminium')}}   |1000 {{__('office.da')}}| x {{$quotation['order']['indoorLooperAluminium']}} | {{ $quotation['order']['indoorLooperAluminium'] * 1000 }} {{__('office.da')}} |
@endif
@if($quotation['order']['outdoorLooperPet'])
|  {{__('office.outdoorlooperpet')}}   |5000 {{__('office.da')}}| x {{$quotation['order']['outdoorLooperPet']}} | {{ $quotation['order']['outdoorLooperPet'] * 5000 }} {{__('office.da')}} |
@endif
@if($quotation['order']['outdoorLooperRp'])
|  {{__('office.outdoorlooperrp')}}   |5000 {{__('office.da')}}| x {{$quotation['order']['outdoorLooperRp']}} | {{ $quotation['order']['outdoorLooperRp'] * 5000 }} {{__('office.da')}} |
@endif
@if($quotation['order']['outdoorLooperPaper'])
|  {{__('office.outdoorlooperpaper')}}   |5000 {{__('office.da')}}| x {{$quotation['order']['outdoorLooperPaper']}} | {{ $quotation['order']['outdoorLooperPaper'] * 5000 }} {{__('office.da')}} |
@endif
@if($quotation['order']['outdoorLooperAluminium'])
|  {{__('office.outdoorlooperaluminium')}}   |5000 {{__('office.da')}}| x {{$quotation['order']['outdoorLooperAluminium']}} | {{ $quotation['order']['outdoorLooperAluminium'] * 5000 }} {{__('office.da')}} |
@endif
@if($quotation['order']['outdoorLooperPetBig'])
|  {{__('office.outdoorstationpet')}}   |48000 {{__('office.da')}}| x {{$quotation['order']['outdoorLooperPetBig']}} | {{ $quotation['order']['outdoorLooperPetBig'] * 48000 }} {{__('office.da')}} |
@endif
@if($quotation['order']['outdoorLooperPaperBig'])
|  {{__('office.outdoorstationpaper')}}   | 48000 {{__('office.da')}}| x {{$quotation['order']['outdoorLooperPaperBig']}} | {{ $quotation['order']['outdoorLooperPaperBig'] * 48000 }} {{__('office.da')}} |
@endif
@if(false)
|  {{__('office.nrecyclibags')}} 	 | 960 {{__('office.da')}}| x {{$quotation['order']['bags']}}          | {{$quotation['order']['bags'] * 960}} {{__('office.da')}} |
@endif
@if(false)
|  {{__('office.gourde')}} 	 | 1200 {{__('office.da')}}| x {{$quotation['order']['aluminiumSportBottle']}}          | {{$quotation['order']['aluminiumSportBottle'] * 1200}} {{__('office.da')}} |
@endif
@if(false)
|  {{__('office.mug')}} 	 | 800 {{__('office.da')}}| x {{$quotation['order']['glassMug']}}          | {{$quotation['order']['glassMug'] * 800}} {{__('office.da')}} |
@endif
@if(false)
|  {{__('office.isotherme')}} 	 | 1500 {{__('office.da')}}| x {{$quotation['order']['thermos']}}          | {{$quotation['order']['thermos'] * 1500}} {{__('office.da')}} |
@endif
@if(false)
|  {{__('office.tshirt')}} 	 | 2000 {{__('office.da')}}| x {{$quotation['order']['tShirt']}}          | {{$quotation['order']['tShirt'] * 2000}} {{__('office.da')}} |
@endif
@if(false)
|  {{__('office.polo_shirt')}} 	 | 2000 {{__('office.da')}}| x {{$quotation['order']['poloShirt']}}          | {{$quotation['order']['poloShirt'] * 2000}} {{__('office.da')}} |
@endif
@if(false)
|  {{__('office.sweat_shirt')}} 	 | 3000 {{__('office.da')}}| x {{$quotation['order']['sweatShirt']}}          | {{$quotation['order']['sweatShirt'] * 3000}} {{__('office.da')}} |
@endif
@if($quotation['collect_contribution_price'])
|  {{__('office.collectcontribution')}} |{{ $quotation['collect_contribution_price'] }} {{__('office.da')}} | x 1   | {{$quotation['collect_contribution_price'] }} {{__('office.da')}} |
@endif
@if($quotation['ecotracker_price'])
|  {{__('office.nrecycliecotracker')}} 		| {{$quotation['ecotracker_price']}} {{__('office.da')}} | x 1   | {{$quotation['ecotracker_price']}} {{__('office.da')}}|
@endif
|  {{__('office.livraison')}}   | {{$quotation['livraison']}} {{__('office.da')}}| x 1 | {{ $quotation['livraison'] }} {{__('office.da')}} |

@endcomponent
@component('mail::table')
|                |                |
| :------------- |-------------:  |
| {{__('office.totalht')}}    | {{ $quotation['totalht'] }} {{__('office.da')}} |
| {{__('office.tva') }}   | {{ $quotation['tva'] }} {{__('office.da')}} |
| {{__('office.total')}}    | {{ $quotation['total'] }} {{__('office.da')}}|

@endcomponent

@component('mail::subcopy')
  <div>
    <p style="text-align:left;">
      <!-- {{__('office.seventh_msg')}}<strong style="color:#41E2F8">{{__('office.eigth_msg')}}</strong><br> -->
      {{__('office.ninth_msg')}}<strong>{{ $quotation['date'] }}.</strong><br>
      {{__('office.tenth_msg')}}<strong style="color:#41E2F8"> office@nrecycli.com</strong><br>
      {{__('office.eleventh_msg')}}
    </p>
  </div>
@endcomponent


@endcomponent


