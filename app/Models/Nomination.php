<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Meet;

class Nomination extends Model
{
    public function validateRequest(Request $request)
    {
      $request->validate([
          'meet_id'  => 'required',
          'ime'  => 'required',
          'prezime'  => 'required',
          'email'  => 'required',
          'drzava'  => 'required',
          'datum_r'  => 'required',
          'spol'  => 'required',
          'discipline'  => 'required',
          'kategorija'  => 'required',
          'dobna'  => 'required',
         ]);    
      $this->setRequest($request);    
      return $this;
    }
    public static function storeData($request)
 {
    function sentence_case($string) {
        $sentences = explode(" ",$string);
        $sentences = array_reverse($sentences);
        $new_string = '';
        foreach ($sentences as $key => $sentence) {
           $new_string = ucfirst(mb_strtolower(trim($sentence)))." ".$new_string;
        }
        return $new_string;
    }
    
    $disciplines = $request->discipline;
    $disc_meet = "";
    foreach ($disciplines as $disciplina) {           
        $disc_meet = $disc_meet.','.$disciplina;
    } 
    $disc_meet = ltrim($disc_meet, $disc_meet[0]);
    $ime = sentence_case($request->ime);
    $prezime = sentence_case($request->prezime);
    $klub = sentence_case($request->klub);
    return self::insertGetId([
        'meet_id'       =>  $request->meet_id,
        'ime'           =>  $ime,
        'prezime'       =>  $prezime,
        'email'         =>  $request->email,
        'klub'          =>  $klub,
        'drzava'        =>  $request->drzava,
        'datum'         =>  $request->datum_r,
        'spol'          =>  $request->spol,
        'disciplina'    =>  $disc_meet,
        'kategorijat'   =>  $request->kategorija,
        'kategorijag'   =>  $request->dobna,
        'created_at'    =>  Carbon::now(),
        'updated_at'    =>  Carbon::now()
    ]);
 }
 private function setRequest($request)
 {
     $this->request = $request;
 }
  public function meet()
    {
     return $this->belongsTo(Meet::class);
    }
}
