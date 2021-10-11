<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recyclables;
use App\Models\Transaction;


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

        // return $user->recyclables;
        
        // // $user_recyclables = Recyclables::firstOrCreate(['user_id'=> $request->office_id]);
        
        // $user_recyclables->pet = $user_recyclables->pet + $request->pet;

        // return [
        //     'joha' => User::where('id',$request->office_id)->with('recyclables')
        // ];

        // $user->paper = $user->paper + $request->paper;

        // $user->alluminium = $user->alluminium + $request->aluminium;

        // $user->save();

        // OfficeTransaction::create([
        //     'office_id' => $request->office_id,
        //     'office_company_name' => $request->office_company_name,
        //     'office_phone_number' => $request->office_phone_number,
        //     'office_email' => $request->office_email,
        //     'plastic' => $request->plastic,
        //     'paper' => $request->paper,
        //     'aluminium' => $request->aluminium,
        // ]);

        // $history = OfficeTransaction::all();
        // $offices = Office::all();


        return ['success' => 'Transaction has been made Successfully!'];
        // return ['history' => $history,'offices' => $offices,'success' => 'Transaction has been made Successfully!'];

        }
}
