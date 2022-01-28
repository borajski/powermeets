<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;

class UserDetail extends Model
{
  //  use HasFactory;
  public function validateRequest(Request $request)
{
  $request->validate([
      'user_fname'  => 'required',
      'user_lname' => 'required',
  ]);

  $this->setRequest($request);

  return $this;
}

public static function storeData($request, $user_id)
{
    return self::insertGetId([
        'user_id' => $user_id,
        'fname' => isset($request->user_fname) ? $request->user_fname : $request->user_name,
        'lname' => $request->user_lname,
        'country' => $request->user_country,
        'public' => $request->user_public,
       'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]);
}
public static function updateData($request, $user_id)
  {
    if($request->live == 'on')
     $live = 'da';
    else
     $live = 'ne';
  
      return self::where('user_id', $user_id)->update([
          'fname' => isset($request->user_fname) ? $request->user_fname : $request->user_name,
          'lname' => $request->user_lname,
          'country' => $request->user_country,
          'public' => $request->user_public,
          'role' => $request->user_role,
          'live' => $live,
          'updated_at' => Carbon::now()
      ]);
  }
private function setRequest($request)
  {
      $this->request = $request;
  }
  public function updateImagePath($user_id, $path)
    {
        return UserDetail::where('user_id', $user_id)->update([
            'avatar' => $path
        ]);
    }
    public function user()
    {
     return $this->belongsTo(User::class);
    }
}
