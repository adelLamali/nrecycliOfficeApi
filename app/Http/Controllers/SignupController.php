<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function index(Request $request)  
    {

        $data = $this->validate($request,[
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'address' => 'required',
            'office_name' => 'required',
            'phone_number' => ['required','unique:users','regex:/^(0)(5|6|7)[0-9]{8}$/'],
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
            'qrcode' => base64_encode($data['office_name']),
        ]);

        return $user;
    } 
}
