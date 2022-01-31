<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gensett;

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
    $disciplines = $request->discipline;
    $disc_meet = "";
    foreach ($disciplines as $disciplina) {           
        $disc_meet = $disc_meet.','.$disciplina;
    } 
    $disc_meet = ltrim($disc_meet, $disc_meet[0]);

    return self::insertGetId([
        'user_id'       =>  auth()->user()->id,
        'naziv'         =>  $request->naziv,
        'organizator'   =>  $request->organizator,
        'federacija'    =>  $request->federacija,
        'mjesto'        =>  $request->mjesto,
        'discipline'    =>  $disc_meet,
        'opis'          =>  $request->opis,
        'datump'        =>  new Carbon($request->datump),
        'datumk'        =>  new Carbon($request->datumk),
        'created_at'    =>  Carbon::now(),
        'updated_at'    =>  Carbon::now()
    ]);
}
public static function updateData($request, $meet_id)
  {
    $disciplines = $request->discipline;
    $disc_meet = "";
    foreach ($disciplines as $disciplina) {           
        $disc_meet = $disc_meet.','.$disciplina;
    } 
    $disc_meet = ltrim($disc_meet, $disc_meet[0]);

      return self::where('id', $meet_id)->update([
             'user_id'       =>  auth()->user()->id,
        'naziv'         =>  $request->naziv,
        'organizator'   =>  $request->organizator,
        'federacija'    =>  $request->federacija,
        'mjesto'        =>  $request->mjesto,
        'discipline'    =>  $disc_meet,
        'opis'          =>  $request->opis,
        'datump'        =>  new Carbon($request->datump),
        'datumk'        =>  new Carbon($request->datumk),
        'updated_at'    =>  Carbon::now()
      ]);
  }
private function setRequest($request)
  {
      $this->request = $request;
  }
  public function updateImagePath($meet_id, $path)
  {
      return Meet::where('id', $meet_id)->update([
          'slika' => $path
      ]);
  }
    public function user()
    {
     return $this->belongsTo(User::class);
    }
    public function gensetts()
    {
        return $this->hasOne(Gensett::class, 'meet_id');
    }
}
