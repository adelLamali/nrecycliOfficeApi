<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Quotation;
use App\Mail\Forfais;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;

use App\Models\Transaction;
use App\Models\Credentials;
use App\Models\Counter;
use App\Models\User;
use App\Models\Profile;

use Illuminate\Support\Facades\Hash;
use PDF;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

use Str;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function create(Request $request)
    {
        // return 'hoho';
        
        $data = $request->validate([
            'phone_number' => ['required','unique:users','regex:/^(0)(5|6|7)[0-9]{8}$/'], 
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'office_name' => 'required',
            'address' => 'required',
            'registre' => 'required',
            'nif' => 'required',
            'nis' => 'required',
            'rip' => 'required',
            'invoice_number' => 'required',
            'to_be_delivered_at' => 'required',
        ]);

        $user = User::create([
            'email' => $data['email'],
			'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
            'address' => $data['address'],
            'office_name' => $data['office_name'],
        ]);

        $profile->activated = true;
        $profile->confirmed = true;
        $profile->delivered_at = NOW();
        $profile->save();

        $credentials = Credentials::updateOrCreate(['user_id' => $user->id ],[
            'user_id' => $user->id,
            'registre' => $request->registre ,
            'nif' => $request->nif ,
            'nis' => $request->nis ,
            'rip' => $request->rip ,
            'invoice_number' => $request->invoice_number ,
            'to_be_delivered_at' => $request->to_be_delivered_at ,
        ]);

        $users = User::with('profile')
                        ->with('recyclables')
                        ->with('transactions')
                        ->with('credentials')
                        ->with('schedule')
                        ->get();

        return ['users' => $users];

    }
    
    public function order(Request $request)
    {

        // return $request->ecotracker_price;
        
        $user = auth()->user();

        $profile = $user->profile;

        $prefix = 'op-';

        $counter = Counter::where('id',1)->first();

        $counter->quotation_number = $counter->quotation_number + 1;

        $counter->save();

        if($user->credentials == null){

            $credential = Credentials::create([
                'user_id' => $user->id,
                'quotation_number' => $prefix.$counter->quotation_number,
            ]);

        }else{
            
            $user->credentials->quotation_number = $prefix.$counter->quotation_number;
            $user->credentials->save();

        };

        $customer = new Party([
            'office_name'   => $profile->office_name,
            'address'       => $profile->address,
            'phone_number'  => $user->phone_number,
            'email'  => $user->email,
            'date_now' => date("Y-m-d"), 
            'number' => $prefix.$counter->quotation_number,
        ]);

        // $amount = $request->order['indoorLooperPet'] + $request->order['indoorLooperRp'] +
        //           $request->order['indoorLooperPaper'] + $request->order['indoorLooperAluminium'];

        // switch ( $amount ) {
        //     case $amount === 1 :
        //         $discount = 0;
        //         break;
        //     case $amount === 2 || $amount === 3 :
        //         $discount = 500;
        //         break;
        //     case $amount === 4 || $amount === 5 :
        //         $discount = 1400;
        //         break;
        //     case $amount >= 6 && $amount <= 9 :
        //         $discount = 2000;
        //         break;
        //     case $amount >= 10 && $amount <= 19 :
        //         $discount = 3500;
        //         break;
        //     case $amount >= 20 :
        //         $discount = 5000;
        //         break;
        // };

        // return [ 'success' => $discount ];

        $items = [  
            (new InvoiceItem())->title("Atelier: “L'Art du Recyclage”")->pricePerUnit($request->workshop_price)->quantity($request->order['workshop']?1:0),
            (new InvoiceItem())->title("Nrecycli looper interieur - P.E.T")->pricePerUnit(1850)->quantity($request->order['indoorLooperPet']),
            (new InvoiceItem())->title("Nrecycli looper interieur - P.E.H.D et P.P")->pricePerUnit(1850)->quantity($request->order['indoorLooperRp']),
            (new InvoiceItem())->title("Nrecycli looper interieur - Papier")->pricePerUnit(1850)->quantity($request->order['indoorLooperPaper']),
            (new InvoiceItem())->title("Nrecycli looper interieur - Aluminium")->pricePerUnit(1850)->quantity($request->order['indoorLooperAluminium']),
            (new InvoiceItem())->title("Nrecycli station a deux flux")->pricePerUnit(29800)->quantity($request->order['twoFlowBins']),
            (new InvoiceItem())->title("Nrecycli station a trois flux")->pricePerUnit(45300)->quantity($request->order['threeFlowBins']),
            (new InvoiceItem())->title("Nrecycli looper extérieur - P.E.T")->pricePerUnit(5000)->quantity($request->order['outdoorLooperPet']),
            (new InvoiceItem())->title("Nrecycli looper extérieur - P.E.H.D et P.P")->pricePerUnit(5000)->quantity($request->order['outdoorLooperRp']),
            (new InvoiceItem())->title("Nrecycli looper extérieur - Papier")->pricePerUnit(5000)->quantity($request->order['outdoorLooperPaper']),
            (new InvoiceItem())->title("Nrecycli looper extérieur - Aluminium")->pricePerUnit(5000)->quantity($request->order['outdoorLooperAluminium']),
            (new InvoiceItem())->title("Nrecycli Beeg looper - P.E.T et P.E.H.D")->pricePerUnit(48000)->quantity($request->order['outdoorLooperPetBig']),
            (new InvoiceItem())->title("Nrecycli Beeg looper - Papier")->pricePerUnit(48000)->quantity($request->order['outdoorLooperPaperBig']),
            // (new InvoiceItem())->title("Sacs Nrecycli")->pricePerUnit(960)->quantity($request->order['bags']),
            // (new InvoiceItem())->title("Gourde Nrecycli")->pricePerUnit(1200)->quantity($request->order['aluminiumSportBottle']),
            // (new InvoiceItem())->title("Mug Nrecycli")->pricePerUnit(800)->quantity($request->order['glassMug']),
            // (new InvoiceItem())->title("Isotherme Nrecycli")->pricePerUnit(1500)->quantity($request->order['thermos']),
            // (new InvoiceItem())->title("T-shirt Nrecycli")->pricePerUnit(2000)->quantity($request->order['tShirt']),
            // (new InvoiceItem())->title("Polo-shirt Nrecycli")->pricePerUnit(2000)->quantity($request->order['poloShirt']),
            // (new InvoiceItem())->title("Sweat-shirt Nrecycli")->pricePerUnit(3000)->quantity($request->order['sweatShirt']),
            (new InvoiceItem())->title("Collecte(s)")->pricePerUnit($request->collect_contribution_price)->quantity($request->collect_contribution_price/36000?1:0),
            (new InvoiceItem())->title("Nrecycli eco-tracker - Bilan environnemental")->pricePerUnit($request->ecotracker_price)->quantity($request->ecotracker_price?1:0),
        ];

        $notes = [
            'Devis de Nrecycli Office Pack',
        ];
        $notes = implode("<br>", $notes);

        $invoice = Invoice::make('SARL Enrecycli')
            ->template('devis')
            // ->totalDiscount($discount)
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
            ->filename('Devis Office')->save('storage');
            // return $request->order; 

        $profile->order = request('order');
        $profile->save();

        $totalht =  $request->workshop_price + 
                    $request->order['twoFlowBins'] * 29800 + 
                    $request->order['threeFlowBins'] * 45300 + 
                    $request->order['indoorLooperPet'] * 1850 + 
                    $request->order['indoorLooperRp'] * 1850 + 
                    $request->order['indoorLooperPaper'] * 1850 + 
                    $request->order['indoorLooperAluminium'] * 1850 +
                    $request->order['outdoorLooperPet'] * 5000 + 
                    $request->order['outdoorLooperRp'] * 5000 + 
                    $request->order['outdoorLooperPaper'] * 5000 + 
                    $request->order['outdoorLooperAluminium'] * 5000 + 
                    $request->order['outdoorLooperPetBig'] * 48000 + 
                    $request->order['outdoorLooperPaperBig'] * 48000 + 
                    // $request->order['bags'] * 960 + 
                    // $request->order['aluminiumSportBottle'] * 1200 +
                    // $request->order['glassMug'] * 800 +
                    // $request->order['thermos'] * 1500 +
                    // $request->order['tShirt'] * 2000 +
                    // $request->order['poloShirt'] * 2000 +
                    // $request->order['sweatShirt'] * 3000 +
                    $request->collect_contribution_price +
                    $request->ecotracker_price;

        // $totalht = $totalht - $discount;
        
        $tva =  ( $totalht * 19 ) / 100;

        $total = $totalht + $tva;

        $quotation = [
            'date' => Carbon::now()->add(7,'day')->format('d-m-Y'),
            // 'discount' => $discount,
            'totalht' => $totalht,
            'tva' => $tva,
            'total' => $total,
            'office_name' => $profile->office_name,
            'address' => $profile->address,
            'phone_number' => $user->phone_number,
            'order' => $request->order,
            'collect_contribution_price' => $request->collect_contribution_price,
            'workshop_price' => $request->workshop_price,
            'ecotracker_price' => $request->ecotracker_price,
        ];

        Mail::to($user->email)
            ->send(new Quotation( $quotation ));
        
        Mail::to('office@nrecycli.com')
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

    public function setpassword(Request $request)
    {

        $validated = $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('token',$request->token)->get()->first();

        // $user->fill([
        //     'password' => Hash::make(request('password'))
        // ])->save();
        
        $user->password = Hash::make(request('password')); 

        $user->save();

        return ['success' => __('office.reset_password_feedback')];

    }

    public function setPickupDate(Request $request)
    {
        
        // return $request->id;
        $profile= Profile::where('user_id',$request->id)->get()->first();

        // $profile = auth()->user()->profile;

        $profile->pickup_date = $request->days;
        $profile->save();

        return [
            'success' => $profile->pickup_date,
        ];

    }

    public function eco(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required',
            'email' => 'required|email',
            'phone_number' => ['required','regex:/^(0)(5|6|7)[0-9]{8}$/'],
            'address' => 'required',
            'offer' => 'required',
        ]);

        $offer = $request['offer'];

        $counter = Counter::where('id',1)->first();

        switch ( $offer ) {
            case $offer === 1 :

                    $offerTitle = "Forfait Eco";

                    $totalAmount=48000;

                    $items = [ 
                        (new InvoiceItem())->title("Nrecycli looper interieur au choix avec un remplacement")->pricePerUnit(3000)->quantity(4),
                        (new InvoiceItem())->title("Une collecte par mois pendant 12 mois")->pricePerUnit(3000)->quantity(12),
                        (new InvoiceItem())->title("Nrecycli eco-tracker - Bilan environnemental")->pricePerUnit(3000)->quantity(4),
                    ];

                break;
            case $offer === 2 :

                $offerTitle = "Forfait Eco-spot";
                
                $totalAmount=140000;

                $items = [ 
                    (new InvoiceItem())->title("Atelier: “L'Art du Recyclage”")->pricePerUnit(3000)->quantity(1),
                    (new InvoiceItem())->title("Nrecycli looper interieur au choix avec un remplacement")->pricePerUnit(3000)->quantity(10),
                    (new InvoiceItem())->title("Nrecycli station de tri sélectif a trois flux")->pricePerUnit(3000)->quantity(1),
                    (new InvoiceItem())->title("Une collecte par mois pendant 12 mois")->pricePerUnit(3000)->quantity(12),
                    (new InvoiceItem())->title("Nrecycli eco-tracker - Bilan environnemental")->pricePerUnit(3000)->quantity(4),
                ];
                break;
            case $offer === 3 :

                $offerTitle = "Forfait Eco-zone";
                
                $totalAmount=360000;

                $items = [ 
                    (new InvoiceItem())->title("Atelier: “L'Art du Recyclage”")->pricePerUnit(3000)->quantity(1),
                    (new InvoiceItem())->title("Nrecycli looper interieur au choix avec un remplacement")->pricePerUnit(3000)->quantity(20),
                    (new InvoiceItem())->title("Nrecycli station de tri sélectif a trois flux")->pricePerUnit(3000)->quantity(2),
                    (new InvoiceItem())->title("Nrecycli Beeg looper au choix")->pricePerUnit(3000)->quantity(2),
                    (new InvoiceItem())->title("Une collecte par mois pendant 12 mois")->pricePerUnit(3000)->quantity(12),
                    (new InvoiceItem())->title("Nrecycli eco-tracker - Bilan environnemental")->pricePerUnit(3000)->quantity(4),
                ];
                break;
            case $offer === 4 :

                $offerTitle = "Forfait Eco-system";
                
                $totalAmount=440000;

                $items = [ 
                    (new InvoiceItem())->title("Atelier: “L'Art du Recyclage”")->pricePerUnit(3000)->quantity(1),
                    (new InvoiceItem())->title("Nrecycli looper interieur au choix avec un remplacement")->pricePerUnit(3000)->quantity(30),
                    (new InvoiceItem())->title("Nrecycli station de tri sélectif a trois flux")->pricePerUnit(3000)->quantity(3),
                    (new InvoiceItem())->title("Nrecycli Beeg looper au choix")->pricePerUnit(3000)->quantity(3),
                    (new InvoiceItem())->title("Une collecte par mois pendant 12 mois")->pricePerUnit(3000)->quantity(24),
                    (new InvoiceItem())->title("Nrecycli eco-tracker - Bilan environnemental")->pricePerUnit(3000)->quantity(4),
                ];
                break;
        };
        
        $customer = new Party([
            'office_name'   => $request['company_name'],
            'address'       => $request['address'],
            'phone_number'  => $request['phone_number'],
            'email'  => $request['email'],
            'date_now' => date("Y-m-d"), 
            'number' => 'op-'.$counter->quotation_number,
            'offre' => $offerTitle,
        ]);

        $devis = Invoice::make('SARL Enrecycli')
            ->template('forfait-devis')
            ->totalAmount($totalAmount)
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
            ->filename('Forfais Office')->save('storage');
            // return $request->order; 

        $forfais=
        [
            'date' => Carbon::now()->add(7,'day')->format('d-m-Y'),
        ];

            Mail::to($request['email'])
                ->send(new Forfais( $forfais ));
        
            Mail::to('office@nrecycli.com')
                ->send(new Forfais( $forfais ));

        return ['feedback' => 'success'];

    }

    public function welcome(Request $request)
    {
        $email = $request->email;

        $user = User::where('email',$email)->get()->first();

        $token = Str::random(30);
        
        $user->token = $token;
        $user->save();
        
        Mail::to($request['email'])
                ->send(new Welcome( $user ));

        return 'success';
    }

}
