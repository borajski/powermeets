<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Nomination;
use App\Models\Meet;

class Athlete extends Model
{
    public function nomination()
    {
     return $this->belongsTo(Nomination::class);
    }
    public function meet()
    {
     return $this->belongsTo(Meet::class);
    }
}
