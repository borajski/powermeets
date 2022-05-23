<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Meet;

class Gensett extends Model
{

   public function validateRequest(Request $request)
   {
     $request->validate([
         'meet_id'  => 'required',
        ]);    
     $this->setRequest($request);    
     return $this;
   }
public static function storeData($id)
{
   return self::insertGetId([
       'meet_id'       =>  $id,
       'created_at'    =>  Carbon::now(),
       'updated_at'    =>  Carbon::now()
   ]);
}
public static function updateData($request, $id)
 {
       return self::where('id', $id)->update([
        'meet_id'       =>  $request->meet_id,
        'aktivan'       =>  $request->aktivan,
        'prijavnica'    =>  $request->prijavnica,
        'nominacije'    =>  $request->nominacije,
        'natjecanje'    =>  $request->natjecanje,
        'rezultati'     =>  $request->rezultati,
        'objave'        =>  $request->objave,
        'em_poruka'     =>  $request->em_poruka,
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
