<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Meet;
use App\Models\Photo;

class Federation extends Model
{
    // use HasFactory;
    public function validateRequest(Request $request)
    {
      $request->validate([
          'name'  => 'required',
          'wm_categories'  => 'required',
          'wf_categories'  => 'required',
          'points_system'  => 'required',
          'age_categories'  => 'required',
          'logo'  => 'required',
          'divisions'  => 'required',
          'disciplines'  => 'required',
      ]);    
      $this->setRequest($request);    
      return $this;
    }
    public static function storeData($request)
{
    
    return self::insertGetId([
        'name'            =>  $request->name,
        'wm_categories'   =>  $request->wm_categories,
        'wf_categories'   =>  $request->wf_categories,
        'age_categories'  =>  $request->age_categories,
        'points_system'    =>  $request->points_system,
        'divisions'    =>  $request->divisions,
        'disciplines'    =>  $request->disciplines,
        'created_at'    =>  Carbon::now(),
        'updated_at'    =>  Carbon::now()
    ]);
}
private function setRequest($request)
  {
      $this->request = $request;
  }
  public function updateImagePath($id, $path)
  {
      return Federation::where('id', $id)->update([
          'logo' => $path
      ]);
  }
  public function meets()
  {
      return $this->hasMany(Meet::class, 'federation_id');
  }
}
