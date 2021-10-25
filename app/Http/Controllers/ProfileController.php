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

use Str;


class ProfileController extends Controller
{
    public function order(Request $request)
    {
        
        $user = auth()->user();

        $profile = $user->profile;

        $customer = new Party([
            'office_name'   => $profile->office_name,
            'address'       => $profile->address,
            'phone_number'  => $user->phone_number,
            'date_now' => date("Y-m-d"), 
            'number' => $profile->id,
        ]);

        $items = [ 
            (new InvoiceItem())->title("Atelier: “L'Art du Recyclage”")->pricePerUnit($request->workshop_price)->quantity($request->order['workshop']?1:0),
            (new InvoiceItem())->title("Nrecycli looper interieur - P.E.T")->pricePerUnit(1850)->quantity($request->order['indoorLooperPet']),
            (new InvoiceItem())->title("Nrecycli looper interieur - P.E.H.D et P.P")->pricePerUnit(1850)->quantity($request->order['indoorLooperRp']),
            (new InvoiceItem())->title("Nrecycli looper interieur - Papier")->pricePerUnit(1850)->quantity($request->order['indoorLooperPaper']),
            (new InvoiceItem())->title("Nrecycli looper interieur - Aluminium")->pricePerUnit(1850)->quantity($request->order['indoorLooperAluminium']),
            (new InvoiceItem())->title("Nrecycli station a deux flux")->pricePerUnit(23800)->quantity($request->order['twoFlowBins']),
            (new InvoiceItem())->title("Nrecycli station a trois flux")->pricePerUnit(29700)->quantity($request->order['threeFlowBins']),
            (new InvoiceItem())->title("Nrecycli looper extérieur - P.E.T")->pricePerUnit(3650)->quantity($request->order['outdoorLooperPet']),
            (new InvoiceItem())->title("Nrecycli looper extérieur - P.E.H.D et P.P")->pricePerUnit(3650)->quantity($request->order['outdoorLooperRp']),
            (new InvoiceItem())->title("Nrecycli looper extérieur - Papier")->pricePerUnit(3650)->quantity($request->order['outdoorLooperPaper']),
            (new InvoiceItem())->title("Nrecycli looper extérieur - Aluminium")->pricePerUnit(3650)->quantity($request->order['outdoorLooperAluminium']),
            (new InvoiceItem())->title("Nrecycli station extérieur - P.E.T")->pricePerUnit(25000)->quantity($request->order['outdoorLooperPetBig']),
            (new InvoiceItem())->title("Nrecycli station extérieur - P.E.H.D et P.P")->pricePerUnit(25000)->quantity($request->order['outdoorLooperPaperBig']),
            (new InvoiceItem())->title("Sacs Nrecycli")->pricePerUnit(960)->quantity($request->order['bags']),
            (new InvoiceItem())->title("Contribution à la collecte")->pricePerUnit($request->collect_contribution_price)->quantity(1),
            (new InvoiceItem())->title("Nrecycli eco-tracker")->pricePerUnit(0)->quantity($request->order['ecotracker']),
        ];

        $notes = [
            'Devis de Nrecycli Office Pack',
        ];
        $notes = implode("<br>", $notes);

        $invoice = Invoice::make('SARL Enrecycli')
            ->template('devis')
            // ->totalDiscount(1000)
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
            ->notes($notes)
            ->logo(public_path('images/icon.png'))
            // You can additionally save generated invoice to configured disk
            ->filename('devis')->save('storage');
            // return $request->order; 

            // $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        // return $link;

        // $invoice->download();
        // $pdf = PDF::loadView('vendor.invoices.templates.default',$invoice);
        // $pdf->download('invoice.pdf');
        // return [ 'success' => 'success' ];

        // $user = auth()->user();

        // $profile = $user->profile;

        $profile->order = request('order');
        $profile->save();

        $totalht =  $request->workshop_price + 
                    $request->order['twoFlowBins'] * 23800 + 
                    $request->order['threeFlowBins'] * 29700 + 
                    $request->order['indoorLooperPet'] * 1850 + 
                    $request->order['indoorLooperRp'] * 1850 + 
                    $request->order['indoorLooperPaper'] * 1850 + 
                    $request->order['indoorLooperAluminium'] * 1850 +
                    $request->order['outdoorLooperPet'] * 3650 + 
                    $request->order['outdoorLooperRp'] * 3650 + 
                    $request->order['outdoorLooperPaper'] * 3650 + 
                    $request->order['outdoorLooperAluminium'] * 3650 + 
                    $request->order['outdoorLooperPetBig'] * 25000 + 
                    $request->order['outdoorLooperPaperBig'] * 25000 + 
                    $request->order['bags'] * 960 + 
                    $request->collect_contribution_price;
        
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
            'collect_contribution_price' => $request->collect_contribution_price,
            'workshop_price' => $request->workshop_price,
        ];

        Mail::to($user->email)
            ->send(new Quotation( $quotation ));

        return [ 'success' => $profile ];

    }

    public function history()
    {

        $user = auth()->user();

        return Transaction::where('user_id',$user->id)->latest()->paginate(6);

    }

    public function setemail()
    {

        $validated = $request->validate([
            'email' => 'required|exists:users',
        ]);

        $user = User::where('email',$request->email)->get()->first();

        $token = Str::random(30);
        $user->token = $token;

        $user->save();

        Mail::to($user->email)
            ->send(new OfficeForgotPassword($user));

        return ['success' => __('office.forgot_password_email')];

    }
}
