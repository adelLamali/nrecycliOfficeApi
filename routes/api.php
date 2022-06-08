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
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ServiceScheduleController;
use App\Http\Controllers\RecyclablesController;
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

Route::middleware('auth:sanctum')->get('/userwith', function (Request $request) {
    return ['data' => auth()->user()->credentials];
});

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return  User::with('profile')
                ->with('recyclables')
                ->with('transactions')
                ->with('credentials')
                ->with('schedule')
                ->get();
});

Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
    return auth()->user()->profile;
});

Route::middleware('auth:sanctum')->get('/recyclables', function (Request $request) {
    return $request->user()->recyclables;
});

Route::middleware('auth:sanctum')->get('/credentials', function (Request $request) {
    return $request->user()->credentials;
});

Route::middleware('auth:sanctum')->get('/schedule', function (Request $request) {
    return $request->user()->schedule;
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

Route::post('office/transaction',[TransactionController::class,'transaction']);
Route::post('office/transaction/history',[TransactionController::class,'history']);
Route::post('office/transaction/history/delete',[TransactionController::class,'historyDelete']);
Route::post('office/credentials',[TransactionController::class,'credentials']);
Route::post('office/activate',[TransactionController::class,'activate']);
Route::post('office/facture',[TransactionController::class,'facture']);
Route::post('office/client',[ProfileController::class,'create']);

Route::post('office/edit/recyclables',[RecyclablesController::class,'edit']);

Route::post('office/quotaion/eco',[ProfileController::class,'eco']);


Route::post('forgotpassword/setemail',[SettingsController::class,'setemail']);

Route::get('office/getCalledNow',[ServiceScheduleController::class,'getCalledNow']);
Route::post('office/scheduleCall',[ServiceScheduleController::class,'scheduleCall']);
Route::post('office/scheduleCall/recieveEmail',[ServiceScheduleController::class,'recieveEmail']);


Route::post('office/setPickupDate',[ProfileController::class,'setPickupDate']);

Route::post('forgotpassword/setpassword',[ProfileController::class, 'setpassword']);
Route::post('welcomeEmail',[ProfileController::class, 'welcome']);



// Route::post('resetpasswordwithtoken','Office\OfficepackController@resetpasswordwithtoken');






//office
