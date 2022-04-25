<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Nomination;
use App\Models\Meet;
use App\Models\Result;

class Athlete extends Model
{
    public function nomination()
    {
     return $this->belongsTo(Nomination::class);
    }
    public function results()
    {
        return $this->hasOne(Result::class, 'athlete_id');
    }
    public function meet()
    {
        return $this->belongsTo(Meet::class);
    }
}
