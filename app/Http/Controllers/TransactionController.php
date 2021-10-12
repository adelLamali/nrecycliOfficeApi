<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recyclables;
use App\Models\Transaction;
use App\Models\Credentials;


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
}
