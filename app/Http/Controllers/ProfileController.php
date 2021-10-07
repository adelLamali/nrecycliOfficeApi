<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Quotation;
use Illuminate\Support\Facades\Mail;

use App\Models\Transaction;
use PDF;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;


class ProfileController extends Controller
{
    public function order(Request $request)
    {
        // return $request->order; 

        // $pdf = App::make('dompdf.wrapper');
        // Storage::disk('office')->delete('images/office/'. $office->image);

        // $pdf = PDF::loadView('pdf.devis');
        // $pdf->save(public_path('pdf/test.pdf'));
        // return $pdf->stream();

        $user = auth()->user();

        $profile = $user->profile;


        $customer = new Party([
            'office_name'   => $profile->office_name,
            'address'       => $profile->address,
            'phone_number'  => $user->phone_number,
        ]);

        $items = [ 
            (new InvoiceItem())->title(__('office.workshop'))->pricePerUnit(25000)->quantity($request->order['workshop']/10),
            (new InvoiceItem())->title(__('office.twostreams'))->pricePerUnit(23800)->quantity($request->order['twoFlowBins']),
            (new InvoiceItem())->title(__('office.threestreams'))->pricePerUnit(29700)->quantity($request->order['threeFlowBins']),
            (new InvoiceItem())->title(__('office.threestreams'))->pricePerUnit(1850)->quantity($request->order['threeFlowBins']),
            (new InvoiceItem())->title(__('office.threestreams'))->pricePerUnit(1850)->quantity($request->order['threeFlowBins']),
            (new InvoiceItem())->title(__('office.threestreams'))->pricePerUnit(1850)->quantity($request->order['threeFlowBins']),
            (new InvoiceItem())->title(__('office.threestreams'))->pricePerUnit(1850)->quantity($request->order['threeFlowBins']),
            (new InvoiceItem())->title(__('office.nrecyclibags'))->pricePerUnit(960)->quantity($request->order['bags']),
            (new InvoiceItem())->title(__('office.collectcontribution'))->pricePerUnit(56400)->quantity($request->order['collectContribution']),
            (new InvoiceItem())->title(__('office.nrecycliecotracker'))->pricePerUnit(0)->quantity($request->order['ecotracker']),
        ];

        // $notes = [
        //     'your multiline',
        //     'additional notes',
        //     'in regards of delivery or something else',
        // ];
        // $notes = implode("<br>", $notes);

        $invoice = Invoice::make('SARL Nrecycli')
            ->taxRate(19)
            ->series('BIG')
            // ability to include translated invoice status
            // in case it was paid
            // ->status(__('invoices::invoice.paid'))
            ->sequence(667)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            // ->seller($client)
            ->buyer($customer)
            // ->date(now()->subWeeks(3))
            // ->dateFormat('m/d/Y')
            // ->payUntilDays(14)
            ->currencySymbol('DZD')
            ->currencyCode('DZD')
            ->currencyFormat('{VALUE} {SYMBOL}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            // ->filename($client->name . ' ' . $customer->name)
            ->addItems($items)
            // ->notes($notes)
            ->logo(public_path('images/icon.png'))
            // You can additionally save generated invoice to configured disk
            ->filename('devis')->save('storage');

        $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        // return $link;

        // $invoice->download();
        return [ 'success' => $link ];

        $user = auth()->user();

        $profile = $user->profile;

        $profile->order = request('order');
        $profile->save();

        $totalht =  $request->order['workshop'] / 10 * 25000 + 
                    $request->order['twoFlowBins'] * 23800 + 
                    $request->order['threeFlowBins'] * 29700 + 
                    $request->order['cardboardBinPet'] * 1850 + 
                    $request->order['cardboardBinRp'] * 1850 + 
                    $request->order['cardboardBinAluminium'] * 1850 + 
                    $request->order['cardboardBinPaper'] * 1850 + 
                    $request->order['bags'] * 960 + 
                    $request->order['collectContribution'] * 56400 ;
        
        $tva =  ( $totalht * 19 ) / 100;

        $total = $totalht + $tva;

        $quotation = [
            'totalht' => $totalht,
            'tva' => $tva,
            'total' => $total,
            'office_name' => $profile->office_name,
            'address' => $profile->address,
            'phone_number' => $user->phone_number,
            'order' => $request->order,
        ];

        Mail::to($user->email)
            ->send(new Quotation( $quotation ));

        // Mail::to("lamali.adel1@gmail.com")
        //     ->send(new Quotation( $request->order ));

        // return  ["success" => __('office.placeorder')];

        return [ 'success' => $profile ];
    }

    public function history()
    {
        $user = auth()->user();

        return Transaction::where('user_id',$user->id)->latest()->paginate(6);

    }
}
