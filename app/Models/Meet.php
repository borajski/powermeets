<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Meet extends Model
{
    public function user()
    {
     return $this->belongsTo(User::class);
    }
}
