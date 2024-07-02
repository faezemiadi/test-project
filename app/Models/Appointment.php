<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['consultant_id','day_of_week','start_time','end_time','date','status'];
    
    public function consultant(){

        return $this->belongsTo(Consultant::class);
    }
   
    public function getNameWeekAttribute(){

        switch ($this->day_of_week) {
            case '1':
                return 'شنبه';
                break;
            case '2':
                return 'یکشنبه';
                break;
            case '3':
                return 'دوشنبه';
                break;
            case '4':
                return 'سه شنبه';
                break;
            case '5':
                return 'چهارشنبه';
                break;      
            case '6':
                return 'پنجشنبه';
                break;
        }

    }
}
