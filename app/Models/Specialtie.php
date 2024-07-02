<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialtie extends Model
{
    use HasFactory;

    protected $fillable = ['specialtie_name'];

    public function consultants(){

        return $this->belongsToMany(Consultant::class);
    }
}
