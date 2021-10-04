<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class SigninController extends Controller
{

    public function index(Request $request)
    {

        // return '$request';

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

       

        // if (!$auth = Auth::attempt(['email' => request('email')], request('remember'))) {
        if (!$auth = Auth::attempt(['email' => request('email'), 'password' => request('password')], request('remember'))) {
            return response()->json([
                'errors' => [
                    'password' => [
                        // __('validation.password_signin')
                        'error'
                        ]
                    ]
                ],422);
        }
        return response() -> json([
    
            'data' =>  ''

        ]);
    }

}
