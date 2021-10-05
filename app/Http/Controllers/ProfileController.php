<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Quotation;
use Illuminate\Support\Facades\Mail;

use App\Models\Transaction;
use PDF;

class ProfileController extends Controller
{
    public function order(Request $request)
    {
        // return $request->order; 

        // $pdf = App::make('dompdf.wrapper');
        // Storage::disk('office')->delete('images/office/'. $office->image);

        $pdf = PDF::loadView('pdf.devis');
        $pdf->save(public_path('pdf/test.pdf'));
        // return $pdf->stream();
        return 'success';

        $user = auth()->user();

        $profile = $user->profile;

        $profile->order = request('order');
        $profile->save();

        $totalht =  $request->order['workshop'] / 10 * 25000 + 
                    $request->order['twoFlowBins'] * 23800 + 
                    $request->order['threeFlowBins'] * 29700 + 
                    $request->order['cardboardBinPet'] * 3000 + 
                    $request->order['cardboardBinRp'] * 3000 + 
                    $request->order['cardboardBinAluminium'] * 3000 + 
                    $request->order['cardboardBinPaper'] * 3000 + 
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
