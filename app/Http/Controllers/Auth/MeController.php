<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeController extends Controller
{
    // public function __construct()
    // {

    //     $this->middleware(['auth:sanctum']);

    // }
    public function index(Request $request)
    {

    	return auth()->user();

    }

    // public function index()
    // {

    // 	return [ "data" ];

    // }
}
