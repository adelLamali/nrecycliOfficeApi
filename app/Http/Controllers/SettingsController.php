<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

use App\models\User;

class SettingsController extends Controller
{
    public function editphone(Request $request)
    {
        
        $request->validate([
            // 'phone' => 'required|unique:offices|'regex:/^(0)(5|6|7)[0-9]{8}$/'',
            'phone_number' => ['required','unique:users','regex:/^(0)(5|6|7)[0-9]{8}$/'], 
        ]);
        
        $office = auth()->user();

        $office->phone_number = $request->phone_number;

        $office->save();

        return ["success" =>  __('office.edit')];

    }

    public function editpassword(Request $request)
    {
        
        $validated = $this->validate($request,[
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
            //'new_password_confirmation' => 'required|same:new_password',
        ]);

        $office = auth()->user();


        if (Hash::check($request->current_password, $office->password)) {
            
            $office->fill([
                'password' => Hash::make(request('new_password'))
            ])->save();

            return ["success" =>  __('office.edit')];
                
                
        }else{

            return ['success' =>__('office.yourpasswordisthesame')];
        }
    }

    public function editname(Request $request) 
    {
        $request->validate([
            'office_name' => 'required',
        ]);
        
        $profile = auth()->user()->profile;

        $profile->office_name = $request->office_name;

        $profile->save();

        return ["success" =>  __('office.edit')];
    }

    public function editemail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
        ]);
        
        $profile = auth()->user();

        $profile->email = $request->email;

        $profile->save();

        return ["success" =>  __('office.edit')];
    }

    public function editaddress(Request $request)
    {
        $request->validate([
            'address' => 'required',
        ]);
        
        $profile = auth()->user()->profile;

        $profile->address = $request->address;

        $profile->save();

        return ["success" =>  __('office.edit')];
    }

    public function editimage(Request $request)
    {

        $validate = $request->validate([

            'image' => 'required|image|dimensions:min_width=500,min_height=500,max_width=3000,max_height=3000|mimes:jpeg,jpg,png,webp|max:5000',

        ]);

        $profile = auth()->user()->profile;


        Storage::disk('office')->delete('images/office/'. $profile->image);

        $photo = $request->file('image');

        $file_name = time() . '.' . 'webp';

        $profile->image = $file_name;

        $profile->save();

        Image::make($photo)->encode('webp')->fit(500,500)->save(public_path('images/office/' . $file_name));

        return ['success' => __('office.edit')];
                
    }

    public function setemail(Request $request)
        {
            $validated = $request->validate([
                'email' => 'required|exists:users',
            ]);

            $office = User::where('email',$request->email)->get()->first();

            $token = Str::random(30);
            $office->token = $token;

            $office->save();

            Mail::to($office->email)
                ->send(new OfficeForgotPassword($office));

            return ['success' => __('office.forgot_password_email')];
        }


}
