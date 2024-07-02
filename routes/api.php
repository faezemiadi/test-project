<?php

use App\Http\Controllers\Api\V1\AppointmentController;
use App\Http\Controllers\Api\V1\AppointmentDetailController;
use App\Http\Controllers\Api\V1\ClientController;
use App\Http\Controllers\Api\V1\ConsultantController;
use App\Http\Controllers\Api\V1\StatisticsController;
use App\Http\Controllers\Auth\LoginRegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//Auth routes
Route::prefix('auth')->name('auth.')->group(function(){

    /*step number one to login
      send body params register and guard 
      email is the email of client or consultant
      guard is the client or consultant

      pass the token of response to the loginConfirm method
      otp number send to the email
    */
    Route::post('loginRegister',[LoginRegisterController::class,'loginRegister'])->name('loginRegister');

    /*step number two to login
      token is the query param (get the token of the loginRegister method)
      otp is the number that send to the email of client or consultant
      guard is the client or consultant
    */
    Route::post('loginConfirm/{token}',[LoginRegisterController::class,'loginConfirm'])->name('loginConfirm');
    
    Route::get('logout',[LoginRegisterController::class,'logout'])->middleware('auth:sanctum')->name('logout');

    /*
     send first_name and last_name and gender and phone number or 
     (password or password_confirmation)  and bear token to complete information
    */

    Route::post('completeInfoClient',[LoginRegisterController::class,'completeInfoClient'])->middleware('auth:sanctum')->name('completeInfoClient');

     /*
     send first_name and last_name and gender and phone number and gmc_number or 
     (password or password_confirmation)  and bear token to complete information
    */

    Route::post('completeInfoConsaltant',[LoginRegisterController::class,'completeInfoConsaltant'])->middleware('auth:sanctum')->name('completeInfoConsaltant');

});
 
Route::prefix('v1')->name('v1.')->group(function(){
 
    //get the all consultants with active appointments and reservedAppointments

    Route::get('consultants',[ConsultantController::class,'index'])->name('getConsultantsDetails');

    //save new appointment

    Route::post('saveAppointment',[AppointmentController::class,'store'])->name('saveAppointment');

    //get all clients with appointments

    Route::get('clients',[ClientController::class,'index'])->name('getClientsDetails');

    //reserve the new appointment and send email to client and consultant

    Route::post('bookedAppointment',[AppointmentDetailController::class,'store'])->middleware('auth:sanctum');
    
    //get count the active and not reserved appointment of each consultant

    Route::get('getNumberOfAllActiveAppointment',[StatisticsController::class,'getNumberOfAllActiveAppointment']);

    //get count the reserved appointment of each consultant

    Route::get('getNumberOfAllReservedAppointment',[StatisticsController::class,'getNumberOfAllReservedAppointment']);

    //get count of clients with appointments 

    Route::get('getClientAllReservation',[StatisticsController::class,'getClientAllReservation']);

    //get count of clients with active appointments 

    Route::get('getClientActiveAppointmant',[StatisticsController::class,'getClientActiveAppointmant']);

});