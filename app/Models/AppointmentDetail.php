<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentDetail extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['appointment_id','client_id','subject_id','duration','price','status'];

    public function appointment(){

        return $this->belongsTo(Appointment::class);
    }

    public function client(){

        return $this->belongsTo(Client::class);
    }

    public function subject(){

        return $this->belongsTo(Specialtie::class,'subject_id');
    }
}
