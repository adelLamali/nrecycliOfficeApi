<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\SignoutController;
use App\Http\Controllers\Auth\SigninController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return User::with('profile')
                ->with('recyclables')
                ->with('transactions')
                ->with('credentials')
                ->get();
});

Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
    return $request->user()->profile;
});

Route::middleware('auth:sanctum')->get('/recyclables', function (Request $request) {
    return $request->user()->recyclables;
});

Route::get('/author', function (Request $request) {
    return 'Adel Lamali';
});

Route::group(['prefix' => 'auth/office', 'namespace' => 'Auth'], function () {

    Route::post('signin', [SigninController::class, 'index']);
    
    Route::get('me', [MeController::class, 'index']);

    Route::post('signout', [SignoutController::class, 'index']);

});

Route::post('office/order',[ProfileController::class, 'order'])->middleware('auth:sanctum');
// Route::get('office/order',[ProfileController::class, 'order']);

Route::post('office/signup',[SignupController::class, 'index']);

Route::get('office/history',[ProfileController::class, 'history'])->middleware('auth:sanctum');

Route::post('office/settings/edit/phone',[SettingsController::class ,'editphone']);
Route::post('office/settings/edit/password',[SettingsController::class,'editpassword']);
Route::post('office/settings/edit/name',[SettingsController::class,'editname']);
Route::post('office/settings/edit/email',[SettingsController::class,'editemail']);
Route::post('office/settings/edit/address',[SettingsController::class,'editaddress']);
Route::post('office/settings/edit/image',[SettingsController::class,'editimage']);

// Route::get('officeHistory',function ()
// {

//     $user = auth()->user();

//     return OfficeTransaction::where('office_id',$user->id)->latest()->paginate(3);

// });

// Route::get('offices','Office\OfficepackController@offices');

// Route::post('officesTransaction','Office\OfficepackController@transaction');

// Route::post('addImage',[SettingsController::class,'editImage']); // add image

// Route::get('officeHistory',function ()
// {
//     $currentUser = Auth::guard('office')->user();

//     return OfficeTransaction::where('office_id',$currentUser->id)->latest()->paginate(3);


// });

// Route::post('activateOffice','Office\OfficepackController@activateandpasswordreset');

// Route::post('resetpasswordwithtoken','Office\OfficepackController@resetpasswordwithtoken');

// Route::post('forgotpassword/setemail','Office\OfficepackController@setemail');

// Route::post('forgotpassword/setpassword','Office\OfficepackController@setpassword');




//office
