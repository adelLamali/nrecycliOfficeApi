<?php

namespace App\Http\Controllers;

use App\Models\Recyclables;

use Illuminate\Http\Request;

class RecyclablesController extends Controller
{
    public function edit(Request $request)
    {
        // return $request->id;

        $recyclables = Recyclables::where('id',$request->id)->first();

        $recyclables->pet = $request->pet;
        $recyclables->paper = $request->paper;
        $recyclables->aluminium = $request->aluminium;

        $recyclables->save();

        return ['success'=>'success edit'];



    }
}
