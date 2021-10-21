<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recyclables;
use App\Models\Transaction;
use App\Models\Credentials;
use App\Mail\Invoices;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Support\Facades\Mail;
// use Carbon\Carbon;
use Illuminate\Support\Carbon;


class TransactionController extends Controller
{
    public function transaction(Request $request)
    { 
        $data = $this->validate($request,[
            'pet' => 'required',
            'rigid_plastic' => 'required',
            'paper' => 'required',
            'aluminium' => 'required',
        ]);

        $user = User::where('id',$request->office_id)->get()->first();

        if ($user->recyclables == null ) {

            $user_recyclables = Recyclables::create([
                'user_id'=> $request->office_id,
                'pet' => $data['pet'],
                'rigid_plastic' => $data['rigid_plastic'],
                'paper' => $data['paper'],
                'aluminium' => $data['aluminium'],
            ]);

            Transaction::create([
                'user_id' => $request->office_id,
                'pet' => $request->pet,
                'rigid_plastic' => $request->rigid_plastic,
                'paper' => $request->paper,
                'aluminium' => $request->aluminium,
            ]);
            
        }else{
            $user->recyclables->pet = $user->recyclables->pet + $data['pet'];
            $user->recyclables->rigid_plastic = $user->recyclables->rigid_plastic + $data['rigid_plastic'];
            $user->recyclables->paper = $user->recyclables->paper + $data['paper'];
            $user->recyclables->aluminium = $user->recyclables->aluminium + $data['aluminium'];
            $user->recyclables->save();

            Transaction::create([
                'user_id' => $request->office_id,
                'pet' => $request->pet,
                'rigid_plastic' => $request->rigid_plastic,
                'paper' => $request->paper,
                'aluminium' => $request->aluminium,
            ]);

        };

        return ['success' => 'Transaction has been made Successfully!'];

    }

    public function credentials(Request $request)
    {
        // return $request;
        $data = $this->validate($request,[
            'registre' => 'required',
            'nif' => 'required',
            'nis' => 'required',
            'rip' => 'required',
            'to_be_delivered_at' => 'required',
        ]);

        // $user = User::where('id',$request->office_id)->get()->first();

        $credentials = Credentials::create([
            'user_id' => $request->office_id,
            'registre' => $request->registre ,
            'nif' => $request->nif ,
            'nis' => $request->nis ,
            'rip' => $request->rip ,
            'to_be_delivered_at' => $request->to_be_delivered_at ,
        ]);

        return ['success' => 'Transaction has been made Successfully!'];

    }

    public function activate(Request $request)
    {
        $user = User::where('id',$request->id)->get()->first();

        $profile = $user->profile;
        
        $profile->activated = true;
        $profile->confirmed = true;
        $profile->delivered_at = NOW();
        $profile->save();

    }

    public function facture(Request $request)
    {

        $user = User::where('id',$request->id)->get()->first();

        $profile = $user->profile;

        $credentials = $user->credentials;

        $customer = new Party([
            'office_name'   => $profile->office_name,
            'address'       => $profile->address,
            'phone_number'  => $user->phone_number,
            'registre' => $credentials->registre,
            'nif' => $credentials->nif,
            'nis' => $credentials->nis,
            'rip' => $credentials->rip,
            'date_now' => date("Y-m-d"),
            'number' => $profile->id,
        ]);


        switch ( $profile->order['workshop'] ) {
            case 0:
                $workshop_price = 0;
                break;
            case 10:
                $workshop_price = 25000;
                break;
            case 15:
                $workshop_price = 35000;
                break;
            case 30:
                $workshop_price = 50000;
                break;
        };

        switch ( $profile->order['collectContribution'] ) {
            case 1:
                $collect_contribution_price = 20000;
                break;
            case 2:
                $collect_contribution_price = 30000;
                break;
            case 4:
                $collect_contribution_price = 35000;
                break;
        }
// return ['wp' => $workshop_price,'cc'=>$collect_contribution_price];
        $items = [ 
            // (new InvoiceItem())->title(__('office.workshop'))->pricePerUnit(25000)->quantity($profile->order['workshop']/10),
            // (new InvoiceItem())->title(__('office.twostreams'))->pricePerUnit(23800)->quantity($profile->order['twoFlowBins']),
            // (new InvoiceItem())->title(__('office.threestreams'))->pricePerUnit(29700)->quantity($profile->order['threeFlowBins']),
            // (new InvoiceItem())->title(__('office.cardboardbinpet'))->pricePerUnit(1850)->quantity($profile->order['cardboardBinPet']),
            // (new InvoiceItem())->title(__('office.cardboardbinrp'))->pricePerUnit(1850)->quantity($profile->order['cardboardBinRp']),
            // (new InvoiceItem())->title(__('office.cardboardbinpaper'))->pricePerUnit(1850)->quantity($profile->order['cardboardBinPaper']),
            // (new InvoiceItem())->title(__('office.cardboardbinaluminium'))->pricePerUnit(1850)->quantity($profile->order['cardboardBinAluminium']),
            // (new InvoiceItem())->title(__('office.nrecyclibags'))->pricePerUnit(960)->quantity($profile->order['bags']),
            // (new InvoiceItem())->title(__('office.collectcontribution'))->pricePerUnit(56400)->quantity($profile->order['collectContribution']),
            // (new InvoiceItem())->title(__('office.nrecycliecotracker'))->pricePerUnit(0)->quantity($profile->order['ecotracker']),
            (new InvoiceItem())->title("Atelier: “L'Art du Recyclage”")->pricePerUnit($workshop_price)->quantity($profile->order['workshop']?1:0),
            (new InvoiceItem())->title("Nrecycli looper interieur - P.E.T")->pricePerUnit(1850)->quantity($profile->order['indoorLooperPet']),
            (new InvoiceItem())->title("Nrecycli looper interieur - P.E.H.D et P.P")->pricePerUnit(1850)->quantity($profile->order['indoorLooperRp']),
            (new InvoiceItem())->title("Nrecycli looper interieur - Papier")->pricePerUnit(1850)->quantity($profile->order['indoorLooperPaper']),
            (new InvoiceItem())->title("Nrecycli looper interieur - Aluminium")->pricePerUnit(1850)->quantity($profile->order['indoorLooperAluminium']),
            (new InvoiceItem())->title("Nrecycli station a deux flux")->pricePerUnit(23800)->quantity($profile->order['twoFlowBins']),
            (new InvoiceItem())->title("Nrecycli station a trois flux")->pricePerUnit(29700)->quantity($profile->order['threeFlowBins']),
            (new InvoiceItem())->title("Nrecycli looper extérieur - P.E.T")->pricePerUnit(3650)->quantity($profile->order['outdoorLooperPet']),
            (new InvoiceItem())->title("Nrecycli looper extérieur - P.E.H.D et P.P")->pricePerUnit(3650)->quantity($profile->order['outdoorLooperRp']),
            (new InvoiceItem())->title("Nrecycli looper extérieur - Papier")->pricePerUnit(3650)->quantity($profile->order['outdoorLooperPaper']),
            (new InvoiceItem())->title("Nrecycli looper extérieur - Aluminium")->pricePerUnit(3650)->quantity($profile->order['outdoorLooperAluminium']),
            (new InvoiceItem())->title("Nrecycli station extérieur - P.E.T")->pricePerUnit(25000)->quantity($profile->order['outdoorLooperPetBig']),
            (new InvoiceItem())->title("Nrecycli station extérieur - P.E.H.D et P.P")->pricePerUnit(25000)->quantity($profile->order['outdoorLooperPaperBig']),
            (new InvoiceItem())->title("Sacs Nrecycli")->pricePerUnit(960)->quantity($profile->order['bags']),
            (new InvoiceItem())->title("Contribution à la collecte")->pricePerUnit($collect_contribution_price)->quantity(1),
            (new InvoiceItem())->title("Nrecycli eco-tracker")->pricePerUnit(0)->quantity($profile->order['ecotracker']),

        ];

        $notes = [
            'Facture de Nrecycli Office Pack',
        ];
        $notes = implode("<br>", $notes);

        $invoice = Invoice::make('SARL Enrecycli')
            ->template('facture')
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
            ->dateFormat('m - d - Y')
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

            // return $request->id;

        // $profile->order = request('order');
        // $profile->save();

        $totalht =  $workshop_price + 
                    $profile->order['twoFlowBins'] * 23800 + 
                    $profile->order['threeFlowBins'] * 29700 + 
                    $profile->order['indoorLooperPet'] * 1850 + 
                    $profile->order['indoorLooperRp'] * 1850 + 
                    $profile->order['indoorLooperPaper'] * 1850 + 
                    $profile->order['indoorLooperAluminium'] * 1850 +
                    $profile->order['outdoorLooperPet'] * 3650 + 
                    $profile->order['outdoorLooperRp'] * 3650 + 
                    $profile->order['outdoorLooperPaper'] * 3650 + 
                    $profile->order['outdoorLooperAluminium'] * 3650 + 
                    $profile->order['outdoorLooperPetBig'] * 25000 + 
                    $profile->order['outdoorLooperPaperBig'] * 25000 + 
                    $profile->order['bags'] * 960 + 
                    $collect_contribution_price;
        
        $tva =  ( $totalht * 19 ) / 100;

        $total = $totalht + $tva;

        // $quotation = [
        //     'totalht' => $totalht,
        //     'tva' => $tva,
        //     'total' => $total,
        //     'office_name' => $profile->office_name,
        //     'address' => $profile->address,
        //     'phone_number' => $user->phone_number,
        //     'order' => $request->order,
        // ];

        $invoice=[
            'total' => $total,
            'to_be_delivered_at' => $user->credentials->to_be_delivered_at->format('Y-m-d'),
            'number' => $profile->id,
        ];

        Mail::to($user->email)
            ->send(new Invoices( $invoice ));

        return [ 'success' => $profile ];

    }
}
