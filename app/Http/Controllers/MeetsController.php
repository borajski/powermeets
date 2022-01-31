<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meet;
use App\Models\Photo;


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
    public function front_index()
    {   
        $query = (new Meet())->newQuery();
        $natjecanja = $query->orderBy('datump')->get();
        return view('front_layouts.meets.index')->with('natjecanja',$natjecanja);     
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
       return view('back_layouts.meets.meet')->with('meet',$meet);      
    }
    public static function front_show($id)
    {
       $meet = Meet::find($id);
       return view('front_layouts.meets.meet')->with('meet',$meet);      
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
      if ($meet->slika != NULL)
      {
        Photo::imageDelete($meet, 'meets', 'slika');
      }
      $meet->delete();
      // kod brisanja treba razmotriti i brisanje pripadnih podataka u gensetts tablici i nominations tablici
      return redirect('/meets')->with(['success' => 'Natjecanje je uspješno obrisano!']);
    }
}
