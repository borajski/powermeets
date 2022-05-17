<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meet;
use App\Models\Photo;
use App\Models\Federation;
use App\Models\Gensett;
use App\Models\Nomination;


class MeetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if ((auth()->user()->details->role) == 'admin')
        {
        $query = (new Meet())->newQuery();
        $natjecanja = $query->orderBy('datump')->get();
        return view('back_layouts.meets.index')->with('natjecanja',$natjecanja);
      }
      else {
        $organizator = auth()->user()->id;
        $query = (new Meet())->newQuery()->where('user_id',$organizator);
        $natjecanja = $query->orderBy('datump')->get();
        return view('back_layouts.meets.index')->with('natjecanja',$natjecanja);
      }
    }
    /*
    public function front_index()
    {   
        $query = (new Meet())->newQuery();
        $natjecanja = $query->orderBy('datump')->get();
        return view('front_layouts.meets.index')->with('natjecanja',$natjecanja);    
    }
*/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $query = (new Federation())->newQuery();
      $federacije = $query->orderBy('name')->get();
      return view('back_layouts.meets.new_meet')->with('federacije',$federacije);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $meet = new Meet();
      $stored = $meet->validateRequest($request)->storeData($request); // gives meet id
      if ($stored)
      {
        if ($request->hasFile('slika')) {
          $path = Photo::imageUpload($request->file('slika'), Meet::find($stored), 'meets', 'slika');
          $meet->updateImagePath($stored, $path);
      }
      $gensett = new Gensett();
      $settstored = $gensett->storeData($stored); // gives gensett id
      return redirect('/meets')->with(['success' => 'Meet created successfully!']);
      }
      else {
         return redirect()->back()->with(['error' => 'Oops! Some errors occured!']);
      }     
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        $meet = Meet::find($id);
        $query = (new Federation())->newQuery();
        $federacije = $query->orderBy('name')->get();
        return view('back_layouts.meets.meet')->with('meet',$meet)->with('federacije',$federacije);    
    }
    public static function front_show($id)
    {
       $meet = Meet::find($id);
       $nomination = Nomination::where('meet_id', $id)->get();
       
       $discipline_meet = array(); //discipline za koje su se natjecatelji prijavili na natjecanju
       $division = array(); //array za divizije koje su na natjecanju

       $fed_divisions = explode(",", $meet->federation->divisions);
       foreach ($nomination as $nominacija) {
           $disciplina = explode(",", $nominacija->disciplina);
           foreach ($disciplina as $single) {
               $discipline_meet[] = $single;
           }
       }
       $discipline_meet = array_unique($discipline_meet);
       sort($discipline_meet);

       foreach ($discipline_meet as $single) {
           $prvoslovo = $single[0];
           foreach ($fed_divisions as $feddiv) {
               if ($prvoslovo == $feddiv[0]) {
                   $division[] = $feddiv;
               }
           }
       }
       $division = array_unique($division);
       return view('front_layouts.meets.meet',['discipline_meet'=>$discipline_meet,'division'=>$division,'meet'=>$meet]);
      
         
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $meet = Meet::find($id);
      $updated = $meet->validateRequest($request)->updateData($request,$id);
      if ($updated)
      {
        if ($request->hasFile('slika')) {
          $path = Photo::imageUpload($request->file('slika'), $meet, 'meets', 'slika');
          $meet->updateImagePath($id, $path);
      }
     
      return redirect()->route('meets.show', $meet->id)->with(['success' => 'Natjecanje je uspješno uređeno!']);
      }
      else {
         return redirect()->back()->with(['error' => 'Uf! Došlo je do pogreške u spremanju podataka!']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $meet = Meet::find($id);
      $gensett = Gensett::where('meet_id',$id)->first();
      $nominations = Nomination::where('meet_id',$id)->get();
      if ($meet->slika != NULL)
      {
        Photo::imageDelete($meet, 'meets', 'slika');
      }
      $meet->delete();
      $gensett->delete();
      foreach ($nominations as $nominacija)
      {
        $nominacija->delete();
      }
      // kod brisanja treba razmotriti i brisanje pripadnih podataka u nominations tablici
      return redirect('/meets')->with(['success' => 'Natjecanje je uspješno obrisano!']);
    }
}
