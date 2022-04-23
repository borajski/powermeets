<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Nomination;

class Athlete extends Model
{
    public function nomination()
    {
     return $this->belongsTo(Nomination::class);
    }
}
