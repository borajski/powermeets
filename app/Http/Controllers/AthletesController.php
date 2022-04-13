<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Athlete;
use App\Models\Nomination;
use App\Models\Meet;

class AthletesController extends Controller
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
        
    }
    public function initiate($id)
    {        
        $nomination = Nomination::where('meet_id', $id)->get();
        $meet = Meet::find($id);

        $fed_divisions = explode(",", $meet->federation->divisions);

        foreach ($nomination as $nominacija) {        
            $disciplina = explode(",", $nominacija->disciplina);
            foreach ($disciplina as $single) {
                $naziv_discipline = explode("-", $single);
                $div_indeks = $naziv_discipline[0];
                foreach ($fed_divisions as $feddiv) {
                    if ($div_indeks[0] == $feddiv[0]) {
                        $division = $feddiv;
                    }
                }                
                $single_discipline = $division.' '.$naziv_discipline[1];
                $athlete = new Athlete();
                $athlete->nomination_id = $nominacija->id;
                $athlete->meet_id = $id;
                $athlete->discipline = $single_discipline;
                $athlete->spol = $nominacija->spol;
                $athlete->kategorijat = $nominacija->kategorijat;
                $athlete->kategorijag = $nominacija->kategorijag;
                $athlete->save();
            }
        }
       
        return redirect()->route('athletes.show', [$id]);
        
    }
    public function athletesList($discipline)
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
        $athlete_m = Athlete::where('meet_id', $meet_id)->where('spol','M')->where('discipline', $ispis)->get();
        $tezinske_m = tezkat($athlete_m);
        $athletes_m = array();
        foreach ($athlete_m as $athlete)
        {
          $athletes_m[]["id"] =  $athlete->id;
          $athletes_m[]["ime"] =  $athlete->nomination->ime;
          $athletes_m[]["prezime"] =  $athlete->nomination->prezime;
          $athletes_m[]["kategorijag"] =  $athlete->kategorijag;
          $athletes_m[]["kategorijat"] =  $athlete->kategorijat;
        }

        $athletes_f = Athlete::where('meet_id', $meet_id)->where('spol','Z')->where('discipline', $ispis)->get();
        $tezinske_f = tezkat($athletes_f);

        if (!$athlete_m) {
            return response()->json(['error' => 'Fucking error']);
        }
        if (!$athletes_f) {
            return response()->json(['error' => 'Fucking error']);
        }
        return response()->json(['ispis'=>$ispis,'nominacije_m'=>$athletes_m,'tezinske_m'=>$tezinske_m,'nominacije_f'=>$athletes_f,'tezinske_f'=>$tezinske_f]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $groupes = $request->grupa;
       $ids = $request->idbroj;
       $broj_natjecatelja = $request->athletes_number;
       $disciplina = $request->disciplina;
       echo $disciplina.'<br>';
       echo $broj_natjecatelja.'<br>';
       for ($i=0;$i<$broj_natjecatelja;$i++)
       {
           $athlete = new Athlete();
           $athlete->nomination_id = $ids[$i];
           $athlete->discipline = $request->disciplina;
           $athlete->flight = $groupes[$i];
           $athlete->save();
           echo 'ID='.$ids[$i].'<br>';
           echo 'Grupa'.$groupes[$i].'<br>';
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
        return view('back_layouts.meets.organize',['discipline_meet'=>$discipline_meet,'division'=>$division,'meet'=>$meet]);
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
