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
      /*  $meets = Meet::orderBy('created_at', 'desc')->get();
        return view('layouts.meets.index')->with('meets', $meets); */

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
      return redirect('/home')->with(['success' => 'Meet created successfully!']);
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
       // return view('layouts.meets.show')->with('meet',$meet);
        return $meet;
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
        $pocetna = "A-".$id;
        $meet->frontpage = $pocetna;

        $meet->save();

        return redirect('/meet?id='.$id)->with('success', 'Postavljen kao početna stranica');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
