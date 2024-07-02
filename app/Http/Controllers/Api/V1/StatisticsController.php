<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Client;
use App\Models\Consultant;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
  
    public function getNumberOfAllActiveAppointment(){


        return  Consultant::withCount('activeAppointments')->get();

    }

    public function getNumberOfAllReservedAppointment(){


        return  Consultant::withCount('reservedAppointments')->get();

    }
 
    public function getClientAllReservation(){


        return Client::withCount('AppointmentDetails')->get();

    }

    public function getClientActiveAppointmant(){


        return Client::withCount('ActiveAppointmentDetails')->get();

    }
} 
    