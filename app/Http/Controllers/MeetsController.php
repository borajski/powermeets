<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Photo;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MeetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meets = Meet::orderBy('created_at', 'desc')->get();
        return view('layouts.meets.index')->with('meets', $meets);
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
       
       
       
       /*
        $discipline = $request->input('discipline');
        $disc_meet = "";
        foreach ($discipline as $disciplina) {           
            $disc_meet = $disciplina.','.$disc_meet;
        } 
       return $disc_meet.'<br>radi'; */
       /*
        $this->validate($request, [
            'naziv' => 'required',
            'organizator' => 'required',
            'email' => 'required',
            'federacija' => 'required',
            'mjesto' => 'required',
            'datum-p' => 'required',
            'datum-k' => 'required',
            'logo' => 'image|max:1999',
            'slika' => 'image|max:1999',
        ]);
        $discipline = array("powerlifting","benchpress","squat","deadlift","pushpull",
            "e-powerlifting","e-benchpress","e-squat","e-deadlift","e-pushpull");

        $meet = new Meet;
        $meet->naziv = $request->input('naziv');
        $meet->organizator = $request->input('organizator');
        $meet->email = $request->input('email');
        $meet->federacija = $request->input('federacija');
        // Get filename with extension
        $filenameWithExt = $request->file('logo')->getClientOriginalName();
        // Get just the filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get extension
        $extension = $request->file('logo')->getClientOriginalExtension();
        // Create new filename
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        // Uplaod image
        $path= $request->file('logo')->storeAs('public/slike/'.$request->input('naziv'), $filenameToStore);

        $meet->logo = $filenameToStore;

        //--COVER SLIKA--//
        // Get filename with extension
        $filenameWithExt = $request->file('slika')->getClientOriginalName();
        // Get just the filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get extension
        $extension = $request->file('slika')->getClientOriginalExtension();
        // Create new filename
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        // Uplaod image
        $path= $request->file('slika')->storeAs('public/slike/'.$request->input('naziv'), $filenameToStore);

        $meet->slika = $filenameToStore;

        $meet->mjesto = $request->input('mjesto');
        $meet->datump = $request->input('datum-p');
        $meet->datumk = $request->input('datum-p');
        $disc_meet = "";
        foreach ($discipline as $disciplina) {
            $unos = $request->input($disciplina);
            if ($unos != "")
            {$disc_meet = $unos.','.$disc_meet;}


        }
        $meet->discipline = $disc_meet;
        $meet->opis = $request->input('opis');
        $prijavnica = 'Prijave-'.date("d-m-Y");
        $meet->prijave = $prijavnica;
        Schema::create($prijavnica, function (Blueprint $table) {
            $table->increments('id');
            $table->text('ime');
            $table->text('prezime');
            $table->text('drzava');
            $table->text('klub');
            $table->text('email');
            $table->text('datum');
            $table->text('kategorija_t');
            $table->text('kategorija_g');
            $table->text('spol');
            $table->text('disciplina');

            $table->timestamps();
        });



        $meet->save();

        return redirect('/create_event')->with('success', 'Događaj kreiran'); */
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
