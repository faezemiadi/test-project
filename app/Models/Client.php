<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Client extends Authenticatable
{
    use HasFactory,SoftDeletes,HasApiTokens;

    protected $fillable = ['first_name','last_name','email','mobile','gender','password'];
    
    protected $hidden = ['password'];

    public function AppointmentDetails(){

        return $this->hasMany(AppointmentDetail::class);
    }

    public function ActiveAppointmentDetails(){

        return $this->hasMany(AppointmentDetail::class)->where('status',1);
    }

    public function otps(): MorphMany
    {
        return $this->morphMany(Otp::class, 'otpable');
    }

    public function getFullNameAttribute(){

        return "{$this->first_name} {$this->last_name}";

    }
}
