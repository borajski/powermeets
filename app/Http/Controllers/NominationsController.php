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
        if ($stored) {
        Mail::to($athlete_email)->send(new AppMessageMail($prijavnica, $organizer_email, $nominacija));
 
            if (Mail::failures()) {
                return response()->Fail('Sorry! Please try again latter');
            } else {
                Mail::send(
                    'emails.nom_notice',
                    [
                    'name' => $ime_prezime,
                    'email' => $athlete_email],
                    function ($m) use ($athlete_email, $organizer_email) {
                        $m->from('sinisa.knezevic@alfacat.eu', 'PowerMeets');
                        $m->replyTo($athlete_email);
                        $m->to($organizer_email, 'PowerMeets')
                                    ->subject('New Entry');
                    }
                );
                return redirect()->route('front_meet', $request->meet_id)->with(['success' => $nominacija->meet->naziv.' Uspješno ste prijavljeni!']);
            }
        } else {
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
        $nomination = Nomination::where('meet_id', $id)->get();
        $meet = Meet::find($id);
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
        return view('back_layouts.meets.nominations',['discipline_meet'=>$discipline_meet,'division'=>$division,'meet'=>$meet]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function nomList($discipline)
    {
        function tezkat ($nomination)
        {
            $tezinske = array();
            foreach ($nomination as $nominacija) {
                $tezinske[] = $nominacija->kategorijat;
            }
            $tezinske = array_unique($tezinske);
            sort($tezinske);
            return $tezinske;
        }

        $unos = explode(',', $discipline);
        $meet_id = $unos[0];
        $disciplina = '%'.$unos[1].'%';  
        // traženje punog naziva discipline i divizije
        $meet = Meet::find($meet_id);
        $fed_divisions = explode(",", $meet->federation->divisions);
        $oznaka_divizije = explode('-',$unos[1]);
        $prvoslovo = $oznaka_divizije[0];
        foreach ($fed_divisions as $feddiv) {
            if ($prvoslovo[0] == $feddiv[0]) {
                $divizija = $feddiv;
            }
        }
        $ispis = $divizija.' '.$oznaka_divizije[1];
        // kraj traženja
        $nomination_m = Nomination::where('meet_id', $meet_id)->where('spol','M')->where('disciplina', 'LIKE', $disciplina)->get();
        $tezinske_m = tezkat($nomination_m);

        $nomination_f = Nomination::where('meet_id', $meet_id)->where('spol','Z')->where('disciplina', 'LIKE', $disciplina)->get();
        $tezinske_f = tezkat($nomination_f);

        if (!$nomination_m) {
            return response()->json(['error' => 'Fucking error']);
        }
        if (!$nomination_f) {
            return response()->json(['error' => 'Fucking error']);
        }
        return response()->json(['ispis'=>$ispis,'nominacije_m'=>$nomination_m,'tezinske_m'=>$tezinske_m,'nominacije_f'=>$nomination_f,'tezinske_f'=>$tezinske_f]);
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
        $nominacija = Nomination::find($id);
        $meet_id = $nominacija->meet->id;
        $nominacija->delete();
        return redirect()->route('nominations.show', $meet_id)->with(['success' => 'Natjecatelj je obrisan!']);
    
    }
}
