<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Meet extends Model
{
    public function validateRequest(Request $request)
    {
      $request->validate([
          'naziv'  => 'required',
          'organizator'  => 'required',
          'federacija'  => 'required',
          'mjesto'  => 'required',
          'discipline'  => 'required',
          'datump'  => 'required',
          'datumk'  => 'required',
      ]);    
      $this->setRequest($request);    
      return $this;
    }
    public static function storeData($request)
{
    return self::insertGetId([
        'user_id'       =>  auth()->user()->id,
        'naziv'         =>  $request->naziv,
        'organizator'   =>  $request->organizator,
        'federacija'    =>  $request->federacija,
        'mjesto'        =>  $request->mjesto,
        'discipline'    =>  $request->discipline,
        'opis'          =>  $request->opis,
        'datump'        =>  new Carbon($request->datump),
        'datumk'        =>  new Carbon($request->datumk),
        'created_at'    =>  Carbon::now(),
        'updated_at'    =>  Carbon::now()
    ]);
}

    public function user()
    {
     return $this->belongsTo(User::class);
    }
}
