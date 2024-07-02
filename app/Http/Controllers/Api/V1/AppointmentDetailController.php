<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\BookedAppointmant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AppointmentDetailRequest;
use App\Models\AppointmentDetail;
use Illuminate\Http\Request;

class AppointmentDetailController extends Controller
{
    
   /** 
     * @bodyParam appointment_id required id The appointment. 
     * @bodyParam subject_id required number of the appointment 
     * @bodyParam duration nullable string time of the appointment,Example:30.
     * @bodyParam price nullable amount of the appointment.
    */
    public function store(AppointmentDetailRequest $request)
    {
        $inputs = $request->validated();

        $appointment = AppointmentDetail::create(array_merge($inputs,['client_id' => auth()->user()->id]));

        $appointment->appointment->consultant->update(['status' => 1]);

        event(new BookedAppointmant(auth()->user(),$appointment->appointment->consultant->first(),$appointment->appointment->first()));

        return response()->json([
            'status' => true,
            'msg' => 'وقت مورد نظر به درستی رزرو ایجاد شد'
        ]); 
        
    }
}
