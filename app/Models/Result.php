<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Athlete;

class Result extends Model
{
    public function athlete()
    {
     return $this->belongsTo(Athlete::class);
    }
}
