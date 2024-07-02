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

    Route::post('loginRegister',[LoginRegisterController::class,'loginRegister'])->name('loginRegister');

    Route::post('loginConfirm/{token}',[LoginRegisterController::class,'loginConfirm'])->name('loginConfirm');
    
    Route::get('logout',[LoginRegisterController::class,'logout'])->middleware('auth:sanctum')->name('logout');

    Route::post('completeInfoClient',[LoginRegisterController::class,'completeInfoClient'])->middleware('auth:sanctum')->name('completeInfoClient');

    Route::post('completeInfoConsaltant',[LoginRegisterController::class,'completeInfoConsaltant'])->middleware('auth:sanctum')->name('completeInfoConsaltant');

});

Route::prefix('v1')->name('v1.')->group(function(){
 
    Route::get('consultants',[ConsultantController::class,'index'])->name('getConsultantsDetails');

    Route::post('saveAppointment',[AppointmentController::class,'store'])->name('saveAppointment');

    Route::get('clients',[ClientController::class,'index'])->name('getClientsDetails');

    Route::post('bookedAppointment',[AppointmentDetailController::class,'store'])->middleware('auth:sanctum');

    Route::get('getNumberOfAllActiveAppointment',[StatisticsController::class,'getNumberOfAllActiveAppointment']);

    Route::get('getNumberOfAllReservedAppointment',[StatisticsController::class,'getNumberOfAllReservedAppointment']);

    Route::get('getClientAllReservation',[StatisticsController::class,'getClientAllReservation']);

    Route::get('getClientActiveAppointmant',[StatisticsController::class,'getClientActiveAppointmant']);

});