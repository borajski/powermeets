<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Athlete;
use App\Models\Result;
use Illuminate\Support\Facades\DB;


class ResultsController extends Controller
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
        function reshelPoints ($tezina,$spol)
        {
            $cijela_tezina=floor($tezina);
            $ostatak = $tezina - floor($tezina);
            if ($ostatak < 0.125) 
                $krug="tocna";
            if (($ostatak >= 0.125) AND ($ostatak < 0.375)) 
                $krug="plus025";
            if (($ostatak >= 0.375) AND ($ostatak < 0.625))
                $krug="plus050";
            if (($ostatak >= 0.625) AND ($ostatak < 0.875)) 
                $krug="plus075";
            if ($ostatak > 0.875)
                { 
                 $cijela_tezina=round($tezina);
                 $krug="tocna";
                }  

            if ($spol == "M") {
                $wpoints = DB::table('reshel_m')->where('tezina', $cijela_tezina)->value($krug);
            }
            else {
                $wpoints = DB::table('reshel_f')->where('tezina', $cijela_tezina)->value($krug);
           } 
           $wpoints = (float)str_replace(",",".",$wpoints);         
           return $wpoints;
        }        
        
        $starost            = $request->starost; 
        $tezina             = str_replace(",",".",$request->weight);
        $id                 = $request->athlete_id;
        
        $squat              = $request->squat;
        $bench              = $request->bench;
        $deadlift           = $request->deadlift;
        
        

        $athlete = Athlete::find($id);

        $points =$athlete->nomination->meet->federation->points_system;
        $dobni_koeficijent=1;
        if (($starost < 24) || ($starost  > 39) )
            $dobni_koeficijent = DB::table('agecat')->where('dob', $starost)->value('coef');
     
        $dobni_koeficijent =(float)str_replace(",",".",$dobni_koeficijent);
        switch ($points)
         {
             case "Reshel":
                $bodovi = reshelPoints($tezina,$athlete->spol);
                break;
         }
             
           
         echo "Bodovi:".$bodovi."<br>";
         echo "Bodovi dobni:".$dobni_koeficijent."<br>"; 
         
        
        $athlete->age           = $starost;
        $athlete->kategorijag   = $request->dobna;
        $athlete->weight        = $tezina;
        $athlete->kategorijat   = $request->kategorijat;
        $athlete->weight_coef   = $bodovi;
        $athlete->age_coef      = $dobni_koeficijent;
       $athlete->save(); 

        $result = new Result();
        $result->athlete_id = $id;
        $result->squat1     = str_replace(",",".",$request->squat);
        $result->bench1     = str_replace(",",".",$request->bench);
        $result->deadlift1  = str_replace(",",".",$request->deadlift);
        $result->save();
     
        

       return redirect()->route('athletes.show', $athlete->meet_id)->with(['success' => 'Weighing done!']);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $natjecatelji = Athlete::where('meet_id', $id)->get();
        $discipline_meet = array(); //discipline za koje su se natjecatelji prijavili na natjecanju
 
        foreach ($natjecatelji as $natjecatelj)
        {
            $discipline_meet[] = $natjecatelj->discipline;
        }

        $discipline_meet = array_unique($discipline_meet);
        sort($discipline_meet);
        return view('back_layouts.meets.competitions.index',['discipline'=>$discipline_meet,'meet'=>$id]);
  
    }
    public function showGroup($meet,$group,$discipline)
    {
        $natjecatelji = Athlete::where('meet_id', $meet)->where('flight', $group)->where('discipline', $discipline)->get();
    
        return view('back_layouts.meets.competitions.group_comp',['natjecatelji'=>$natjecatelji,'disciplina'=>$discipline,'grupa'=>$group]);
  
    }
    public function groupes($discipline)
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
        $athletes = Athlete::where('meet_id', $meet_id)->where('discipline', $disciplina)->get();
        if (!$athletes) {
            return response()->json(['error' => 'Fucking error']);
        }        
        $grupe = grupe($athletes);       
           
        return response()->json(['ispis'=>$disciplina,'grupe'=>$grupe,'natjecanje'=>$meet_id]);
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
