<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nomination;
use Mail;
use App\Mail\AppMessageMail;

class NominationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $nomination = new Nomination();
        $stored = $nomination->validateRequest($request)->storeData($request); // gives nomination id
        // slanje poruke natjecatelju nakon prijave, sadržaj 
        $nominacija = Nomination::find($stored);
        $prijavnica = 'Name: '.$nominacija->ime.',
        Surname: '.$nominacija->prezime.',
        Country: '.$nominacija->drzava.',
        Club: '.$nominacija->klub.',
        Birthdate: '.$nominacija->datum.',
        Sex: '.$nominacija->spol.',
        Weight category: '.$nominacija->kategorijat.',
        Age category: '.$nominacija->kategorijag.',
        Disciplines: '.$nominacija->disciplina;
        // kraj sadržaja        
        
        if ($stored)
        {      
            Mail::to($nominacija->email)->send(new AppMessageMail($prijavnica));
            if (Mail::failures()) {
                return response()->Fail('Sorry! Please try again latter');
            }else{
               return redirect()->route('front_meet', $request->meet_id)->with(['success' => $nomination->name.' Uspješno ste prijavljeni!']);
            }            
        }
        else {
           return redirect()->back()->with(['error' => 'Uf! Došlo je do pogreške u spremanju podataka!']);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
