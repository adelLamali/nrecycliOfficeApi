@component('mail::message')

<strong>{{__('office.ordertitle')}}</strong>     

@component('mail::table')
|               | {{__('office.item')}}          | {{__('office.uniteprice')}}    | {{__('office.count')}}     | {{__('office.total')}}    |
| ------------- |:------------- |:------------- | :-------- | :--------|
| <img src="https://office.nrecycli.com/pics/paper_lamp.jpg" style="border-radius:100%" width="30" height="30" alt="nrecycli"> | {{__('office.workshop')}}      |25.000 {{__('office.da')}}| x {{$quotation['order']['workshop']}}      | {{ ( $quotation['order']['workshop'] / 10 ) * 25000 }} {{__('office.da')}} |
| <img src="https://office.nrecycli.com/pics/twoStreams.webp"  style="border-radius:100%" width="30" height="30" alt="nrecycli"> | {{__('office.twostreams')}}    |23.800 {{__('office.da')}}| x {{$quotation['order']['threeFlowBins']}}   | {{ $quotation['order']['threeFlowBins'] * 23800 }} {{__('office.da')}} |
| <img src="https://office.nrecycli.com/pics/threeStreams.webp" style="border-radius:100%" width="30" height="30" alt="nrecycli"> | {{__('office.threestreams')}}   |29.700 {{__('office.da')}}| x {{$quotation['order']['twoFlowBins']}} | {{ $quotation['order']['twoFlowBins'] * 29700 }} {{__('office.da')}} |
| <img src="https://office.nrecycli.com/pics/threeStreams.webp" style="border-radius:100%" width="30" height="30" alt="nrecycli"> | {{__('office.threestreams')}}   |3.000 {{__('office.da')}}| x {{$quotation['order']['cardboardBinPet']}} | {{ $quotation['order']['cardboardBinPet'] * 3000 }} {{__('office.da')}} |
| <img src="https://office.nrecycli.com/pics/threeStreams.webp" style="border-radius:100%" width="30" height="30" alt="nrecycli"> | {{__('office.threestreams')}}   |3.000 {{__('office.da')}}| x {{$quotation['order']['cardboardBinRp']}} | {{ $quotation['order']['cardboardBinRp'] * 3000 }} {{__('office.da')}} |
| <img src="https://office.nrecycli.com/pics/threeStreams.webp" style="border-radius:100%" width="30" height="30" alt="nrecycli"> | {{__('office.threestreams')}}   |3.000 {{__('office.da')}}| x {{$quotation['order']['cardboardBinAluminium']}} | {{ $quotation['order']['cardboardBinAluminium'] * 3000 }} {{__('office.da')}} |
| <img src="https://office.nrecycli.com/pics/threeStreams.webp" style="border-radius:100%" width="30" height="30" alt="nrecycli"> | {{__('office.threestreams')}}   |3.000 {{__('office.da')}}| x {{$quotation['order']['cardboardBinPaper']}} | {{ $quotation['order']['cardboardBinPaper'] * 3000 }} {{__('office.da')}} |
| <img src="https://office.nrecycli.com/pics/n_bags.jpg" style="border-radius:100%" width="30" height="30" alt="nrecycli"> | {{__('office.nrecyclibags')}} 						     				|960 {{__('office.da')}}| x {{$quotation['order']['bags']}}          | {{$quotation['order']['bags'] * 960}} {{__('office.da')}} |
| <img src="https://office.nrecycli.com/pics/track.webp" style="border-radius:100%" width="30" height="30" alt="nrecycli"> | {{__('office.collectcontribution')}} |56.400 {{__('office.da')}}/ANS | x {{$quotation['order']['collectContribution']}}      | {{$quotation['order']['collectContribution'] * 56.400}} {{__('office.da')}} / Ans |
| <img src="https://office.nrecycli.com/pics/ecotracker.webp" style="border-radius:100%" width="30" height="30" alt="nrecycli"> | {{__('office.nrecycliecotracker')}}     							|0 {{__('office.da')}}| x {{$quotation['order']['ecotracker']}}    | 0 {{__('office.da')}}|

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


