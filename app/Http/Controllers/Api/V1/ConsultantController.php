<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsultantResource;
use App\Models\Consultant;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $consultants = Consultant::with('activeAppointments','reservedAppointments')->get();

       return ConsultantResource::collection($consultants);
    }

}
