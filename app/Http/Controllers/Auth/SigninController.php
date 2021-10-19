<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class SigninController extends Controller
{

    public function index(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

       $remember = request('remember');

        // if (!$auth = Auth::attempt(['email' => request('email')], request('remember'))) {
        if (!$auth = Auth::attempt(['email' => request('email'), 'password' => request('password')], $remember )) {
            return response()->json([
                'errors' => [
                    'password' => [
                        __('validation.password_signin')
                        ]
                    ]
                ],422);
        }
        return response() -> json([
    
            'data' =>  ''

        ]);
    }

}
