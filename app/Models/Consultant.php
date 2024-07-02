<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Consultant extends Authenticatable
{
    use HasFactory,SoftDeletes,HasApiTokens;

    protected $fillable = ['first_name','last_name','profile_photo_path','email','mobile','gmc_number','gender','password'];

    protected $hidden = ['password'];

    public function degrees(){

        return $this->belongsToMany(Degree::class,'consultant_degree');
    }
 
    public function specialties(){

        return $this->belongsToMany(Specialtie::class,'consultant_specialite');
    }

    public function appointments(){

        return $this->hasMany(Appointment::class);
    }

    public function activeAppointments(){

        return $this->hasMany(Appointment::class)->where([['date','>=', Carbon::now()->toDateTimeString()],['status',0]]);
    }

    public function reservedAppointments(){

        return $this->hasManyThrough(AppointmentDetail::class,Appointment::class);
    }

    public function otps(): MorphMany
    {
        return $this->morphMany(Otp::class, 'otpable');
    }

    public function getFullNameAttribute(){

        return "{$this->first_name} {$this->last_name}";

    }
}
