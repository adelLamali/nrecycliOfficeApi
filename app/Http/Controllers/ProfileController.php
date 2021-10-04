<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Quotation;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function order(Request $request)
    {
        // return $request->order['workshop'];
        $user = auth()->user();

        $profile = $user->profile;

        $profile->order = request('order');
        $profile->save();

        Mail::to($user->email)
            ->send(new Quotation( $request->order ));

        // Mail::to("lamali.adel1@gmail.com")
        //     ->send(new Quotation( $request->order ));

        // return  ["success" => __('office.placeorder')];

        return [ 'success' => $profile ];
    }
}
