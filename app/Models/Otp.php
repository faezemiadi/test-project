<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Otp extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "otps";

    protected $fillable = ['token','otp_code','otpable_id','otpable_type','login_id','used','type','status'];

    public function otpable(){

        return $this->morphTo();
    }
}
 