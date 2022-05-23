<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Meet;

class Bar extends Model
{
    public function validateRequest(Request $request)
    {
      $request->validate([
          'meet_id'  => 'required',
          'sq_bar'  => 'required',
          'sq_col'  => 'required',
          'bp_bar'  => 'required',
          'bp_col'  => 'required',
          'dl_bar'  => 'required',
          'dl_col'  => 'required',
         ]);    
      $this->setRequest($request);    
      return $this;
    }
 public static function storeData($request)
 {
    return self::insertGetId([
        'meet_id'       =>  $request->meet_id,
        'sqbar'         =>  $request->sq_bar,
        'sqcoll'         =>  $request->sq_col,
        'bpbar'         =>  $request->bp_bar,
        'bpcoll'         =>  $request->bp_col,
        'dlbar'         =>  $request->dl_bar,
        'dlcoll'         =>  $request->dl_col,
        'created_at'    =>  Carbon::now(),
        'updated_at'    =>  Carbon::now()
    ]);
 }
 public static function updateData($request, $id)
  {
        return self::where('id', $id)->update([
         'meet_id'       =>  $request->meet_id,
         'sqbar'         =>  $request->sq_bar,
         'sqcoll'         =>  $request->sq_col,
         'bpbar'         =>  $request->bp_bar,
         'bpcoll'         =>  $request->bp_col,
         'dlbar'         =>  $request->dl_bar,
         'dlcoll'         =>  $request->dl_col,
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
