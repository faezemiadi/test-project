<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AppointmentRequest;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller 
{
    
    /** 
     * @bodyParam consultant_id required id The consultant appointment. 
     * @bodyParam subject_id required id specialtie of the appointment (paitient issue)., 
     * @bodyParam start_time required string time of the start time appointment,Example:08:00.
     * @bodyParam end_time required string time of the end time appointment,Example:08:00.
     * @bodyParam date required string date of The appointment.
    */ 
    
    public function store(AppointmentRequest $request)
    {

        $inputs = $request->validated();

        Appointment::create(array_merge($inputs,[$inputs['date'] => Carbon::parse($inputs['date'])->toDateTimeString()]));

        return response()->json([
            'status' => true,
            'msg' => 'وقت مورد نظر به درستی ایجاد شد'
        ]);
        
    }
}
