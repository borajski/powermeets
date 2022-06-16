<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Athlete;
use App\Models\Nomination;
use App\Models\Meet;
use PDF;


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
                $athlete->name = $nominacija->ime;
                $athlete->surname = $nominacija->prezime;
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
        $disciplina = $unos[1]; 
        $athletes_m = Athlete::where('meet_id', $meet_id)->where('spol','M')->where('discipline', $disciplina)->get();
        $athletes_f = Athlete::where('meet_id', $meet_id)->where('spol','Z')->where('discipline', $disciplina)->get();
        if (!$athletes_m) {
            return response()->json(['error' => 'Fucking error']);
        }
        if (!$athletes_f) {
            return response()->json(['error' => 'Fucking error']);
        }
        $tezinske_m = tezkat($athletes_m);   
        $tezinske_f = tezkat($athletes_f);      
        return response()->json(['ispis'=>$disciplina,'natjecatelji_m'=>$athletes_m,'tezinske_m'=>$tezinske_m,'natjecatelji_f'=>$athletes_f,'tezinske_f'=>$tezinske_f]);
    }
    public function groupesList($discipline)
    {
        function grupe ($natjecatelji)
        {
            $grupe = array();
            foreach ($natjecatelji as $natjecatelj) {
                if ($natjecatelj->flight)
                {
                    $grupe[] = $natjecatelj->flight;
                }                
            }
            $grupe = array_unique($grupe);
            sort($grupe);
            return $grupe;
        }
        
        $unos = explode(',', $discipline);
        $meet_id = $unos[0];
        $disciplina = $unos[1]; 
        $athletes = Athlete::where('meet_id', $meet_id)->where('discipline', $disciplina)->orderByDesc('kategorijag')->get();
        if (!$athletes) {
            return response()->json(['error' => 'Fucking error']);
        }
        if (grupe($athletes) != null)
            $grupe = grupe($athletes);       
        else
            $grupe = "Athletes are not groupped!";       
        return response()->json(['ispis'=>$disciplina,'grupe'=>$grupe,'natjecatelji'=>$athletes]);
    }
    public function rackHeights($discipline)
    {
              
        $unos = explode(',', $discipline);
        $meet_id = $unos[0];
        $disciplina = $unos[1]; 
       
        $athletes = Athlete::where('meet_id', $meet_id)->where('discipline', $disciplina)->orderBy('surname')->get();
        if (!$athletes) {
            return response()->json(['error' => 'Fucking error']);
        }
        return response()->json(['ispis'=>$disciplina,'natjecatelji'=>$athletes]);
    }
    public function weighing($discipline)
    {
              
        $unos = explode(',', $discipline);
        $meet_id = $unos[0];
        $disciplina = $unos[1]; 
       
        $athletes = Athlete::where('meet_id', $meet_id)->where('discipline', $disciplina)->orderBy('surname')->get();
        if (!$athletes) {
            return response()->json(['error' => 'Fucking error']);
        }
        return response()->json(['ispis'=>$disciplina,'natjecatelji'=>$athletes]);
    }
    public function weighingList($discipline)
    {
       
        $unos = explode(',', $discipline);
        $meet_id = $unos[0];
        $disciplina = $unos[1]; 
        $athletes = Athlete::where('meet_id', $meet_id)->where('discipline', $disciplina)->orderBy('surname')->get();
            
        $pdf = PDF::loadView('back_layouts.meets.weighing_lists', ['athletes' => $athletes])->setOptions(['defaultFont' => 'sans-serif']);;
        $naziv = $disciplina.' weighing lists.pdf';
       // return $pdf->download($naziv);
        return $pdf->setPaper('a4')->stream($naziv);
      
  
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   //
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
    public function showAthlete ($id)
    {
        $athlete = Athlete::find($id);
        return view('back_layouts.meets.weighing')->with('athlete',$athlete);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showGroups($id)
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
        return view('back_layouts.meets.flights',['discipline_meet'=>$discipline_meet,'division'=>$division,'meet'=>$meet]);
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
    public function group(Request $request)
    {
        $groupes = $request->grupa;
        $ids = $request->idbroj;
        $broj_natjecatelja = $request->athletes_number;
        for ($i=0;$i<$broj_natjecatelja;$i++)
        {            
            $athlete = Athlete::find($ids[$i]);
            $athlete->flight = $groupes[$i];
            $athlete->save();
        }

        return redirect()->route('athletes.show', $athlete->meet_id)->with(['success' => 'Flight set!']);
    
 
    }
    public function setRack(Request $request)
    {
        $disciplina = $request->disciplina;
        $upit = explode(" ",$disciplina);
        $ids = $request->idbroj;
        $broj_natjecatelja = $request->athletes_number;

        if (($upit[1] == "bench") ||  ($upit[1] == "push&pull"))      
            $racks_bp = $request->rackbp;
        else
           {
               $racks_sq = $request->racksq;
               $racks_bp = $request->rackbp;
            
           }   
        for ($i=0;$i<$broj_natjecatelja;$i++)
        {            
            $athlete = Athlete::find($ids[$i]);
            if (($upit[1] == "bench") ||  ($upit[1] =="push&pull"))            
                $athlete->bp_rack = $racks_bp[$i];
            else
                {
                    $athlete->sq_rack = $racks_sq[$i];
                    $athlete->bp_rack = $racks_bp[$i];
                } 
            
            $athlete->save();
        }
    
        return redirect()->route('athletes.show', $athlete->meet_id)->with(['success' => 'Rack heights set!']);
    
 
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
