<?php

use Illuminate\Support\Facades\Route;
use App\Models\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('fixDb',function ()
{

    $profiles = Profile::get()->all();
    
    for ($i=0; $i < count($profiles); $i++) {

        $profiles[$i]['qrcode'] = base64_encode($profiles[$i]['office_name']);

        $profiles[$i]->save();

    };

    return 'success';

});
