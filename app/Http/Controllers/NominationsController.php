<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nomination;
use Mail;
use App\Mail\AppMessageMail;
use App\Models\Meet;

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
        $organizer_email =  $nominacija->meet->user->email; 
        $athlete_email =    $nominacija->email; 
        $ime_prezime =  $nominacija->ime.' '.$nominacija->prezime;
        if ($stored)
        {  
           Mail::to($athlete_email)->send(new AppMessageMail($prijavnica,$organizer_email,$nominacija));
     
            if (Mail::failures()) {
                return response()->Fail('Sorry! Please try again latter');
            }else{
                Mail::send('emails.nom_notice', [
                    'name' => $ime_prezime,
                    'email' => $athlete_email],
                    function ($m) use ($athlete_email,$organizer_email) {
                            $m->from('sinisa.knezevic@alfacat.eu');
                            $m->replyTo($athlete_email);
                            $m->to($organizer_email, 'PowerMeets')
                                    ->subject('New Entry');
                                });                        
               return redirect()->route('front_meet', $request->meet_id)->with(['success' => $nominacija->meet->naziv.' Uspješno ste prijavljeni!']);
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
    public function nomList($discipline)
    {
       $unos = explode(',',$discipline);
       $meet_id = $unos[0];
       $disciplina = '%'.$unos[1].'%';

       $nomination = Nomination::where('meet_id',$meet_id)->where('disciplina','LIKE',$disciplina)->get();
      
        if (!$nomination){
            return response()->json(['error' => 'Fucking error']);
       }
       return response()->json($nomination); 
    
     
    }
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
