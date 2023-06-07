<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Athlete;
use App\Models\Result;
use App\Models\Bar;
use App\Models\Meet;
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
             
           
      //   echo "Bodovi:".$bodovi."<br>";
      //   echo "Bodovi dobni:".$dobni_koeficijent."<br>"; 
         
        
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
    public function showResults($id)
    {
        $natjecatelji = Athlete::where('meet_id', $id)->get();
        $meet = Meet::find($id);
        $discipline_meet = array(); //discipline za koje su se natjecatelji prijavili na natjecanju
 
        foreach ($natjecatelji as $natjecatelj)
        {
            $discipline_meet[] = $natjecatelj->discipline;
        }

        $discipline_meet = array_unique($discipline_meet);
        sort($discipline_meet);
        return view('back_layouts.meets.results',['discipline'=>$discipline_meet,'meet'=>$meet]);
  
    }
    public function showGroup($input)
    {
      function prefix ($disciplina)
      {
        $upit = array();
        if (strpos($disciplina,"squat"))
        {
         $upit[0] = "SQ";
         $upit[1] = "squat1";
         $upit[2] = "squat2";
         $upit[3] = "squat3";
         //$upit[4] = "squat4";
        }
        if (strpos($disciplina,"bench"))
        {
         $upit[0] = "BP";
         $upit[1] = "bench1";
         $upit[2] = "bench2";
         $upit[3] = "bench3";
         //$upit[4] = "bench4";
      }
         
      if (strpos($disciplina,"deadlift"))
         {
             $upit[0] = "DL";
             $upit[1] = "deadlift1";
             $upit[2] = "deadlift2";
             $upit[3] = "deadlift3";
            // $upit[4] = "deadlift4";
         }
         return $upit;
      }
      function isDone ($broj)
        {
        $decnumber = strlen(strstr($broj,'.'))-1;
        if (($broj < 0) || ($decnumber == 3))
         return true;
        else 
          return false;
        }
     
        $datas = explode(",",$input);
        $meet = $datas[0];
        $group = $datas[1];
        $discipline = $datas[2];
        $stage = $datas[3];
        $next = "squat";
        $powerlifting = array("squat","bench","deadlift");
        $push = array("bench","deadlift");
        $natjecatelji = Athlete::where('meet_id', $meet)->where('flight', $group)->where('discipline', $discipline)->whereNotNull('weight')->get();
        $sipka = Bar::where('meet_id',$meet)->first();
        // procedura za izvlačenje aktivne discipline u troboju
        // dodati i za push&pull
        $indeks = 0;
        if (strpos($discipline,"powerlifting"))
        {
            foreach ($powerlifting as $single)
            {
                $zadnja = $single.'3';
                $gotovi = 0;
               // $flight = Athlete::where('meet_id', $meet)->where('flight', $group)->where('discipline', $discipline)->whereNotNull('weight')->join('results','results.athlete_id','=','athletes.id')->whereNotNull($zadnja)->get();
               foreach ($natjecatelji as $natjecatelj)
               {
                   if(isDone($natjecatelj->results->$zadnja))
                    $gotovi++;                      
               }            
               if (count($natjecatelji) == $gotovi) {
                   $indeks++;
               }                     
            }
              if ($indeks == 3) 
                $indeks = $indeks - 1;

            $next = "powerlifting-".$powerlifting[$indeks];                              
            $prefix =  prefix($next);       
             
        }      
        // kraj procedure za izvlačenje aktivne discipline u troboju
        // procedura za izvlačenje aktivne discipline u push&pullu        
        elseif (strpos($discipline,"push"))
        {
            foreach ($push as $single)
            {
                $zadnja = $single.'3';
                $gotovi = 0;
               // $flight = Athlete::where('meet_id', $meet)->where('flight', $group)->where('discipline', $discipline)->whereNotNull('weight')->join('results','results.athlete_id','=','athletes.id')->whereNotNull($zadnja)->get();
               foreach ($natjecatelji as $natjecatelj)
               {
                   if(isDone($natjecatelj->results->$zadnja))
                    $gotovi++;                      
               }            
               if (count($natjecatelji) == $gotovi) {
                   $indeks++;
               }                     
            }
              if ($indeks == 2) 
                $indeks = $indeks - 1;

            $next = "pushpull-".$push[$indeks];                              
            $prefix =  prefix($next);       
             
        }
        else
          $prefix =  prefix($discipline);
        // kraj procedure za izvlačenje aktivne discipline u push&pullu 

     
        //$broj_natjecatelja = count($natjecatelji);
        $i2 = 0;
        $i3 = 0;
        $i4 = 0;
        
        $upit2 = $prefix[2];
        $upit3 = $prefix[3];
        //$upit4 = $prefix[4]; 
        foreach ($natjecatelji as $natjecatelj)
        {
           if ($natjecatelj->results->$upit2 == NULL)
              $i2++;
            if ($natjecatelj->results->$upit3 == NULL)
              $i3++;
            //if ($natjecatelj->results->$upit4 == NULL)
            else
              $i4++;
        }

        if ($i2 > 0)
          $aktivna = $prefix[1];
        elseif ($i3 > 0)
          $aktivna = $upit2;
        elseif ($i4 > 0)
          $aktivna = $upit3;
        else 
          $aktivna = $prefix[1];
        
     
        $sortiraj = "results.".$aktivna;
        $natjecatelji = Athlete::where('meet_id', $meet)->where('flight', $group)->where('discipline', $discipline)->whereNotNull('weight')->join('results','results.athlete_id','=','athletes.id')->orderBy($sortiraj)->get();
     
        $odradili = array();
        $next = array();

        foreach ($natjecatelji as $natjecatelj)
        {
            if(isDone($natjecatelj->$aktivna))
             $odradili[] = $natjecatelj;
            else
              $next[] = $natjecatelj;        
        }
        if (str_contains($aktivna,"squat"))
{
    $bar = $sipka->sqbar;
    $collar = $sipka->sqcoll;
}

if (str_contains($aktivna,"bench"))
{
    $bar = $sipka->bpbar;
    $collar = $sipka->bpcoll;
}

if (str_contains($aktivna,"deadlift"))
{
    $bar = $sipka->dlbar;
    $collar = $sipka->dlcoll;
}
    
    if ($stage == "1")
      return view('back_layouts.meets.competitions.stage',['slijedeci'=>$next,'odradili'=>$odradili,'disciplina'=>$discipline,'grupa'=>$group,'prefix'=>$prefix,'aktivna'=>$aktivna,'bar'=>$bar,'collar'=>$collar]);
    else
      return view('back_layouts.meets.competitions.group_comp',['slijedeci'=>$next,'odradili'=>$odradili,'disciplina'=>$discipline,'grupa'=>$group,'prefix'=>$prefix,'aktivna'=>$aktivna,'bar'=>$bar,'collar'=>$collar]);
   
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
    public function resList($discipline)
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
        function dobkat ($nomination)
        {
            $dobne = array();
            $dobne_t = array();
            $dobne_j = array();
            $dobne_o = array();
            $dobne_s = array();
            $dobne_m = array();
            foreach ($nomination as $nominacija) {
                $age = $nominacija->kategorijag;
                switch ($age[0])
                {
                    case "T":
                        $dobne_t[] = $age;
                        break;
                    case "J":
                        $dobne_j[] = $age;
                        break;
                    case "S":
                            $dobne_s[] = $age;
                            break;
                    case "O":
                        $dobne_o[] = $age;
                        break;
                    case "M":
                        $dobne_m[] = $age;
                       break;
                }
                
            }
         
            $dobne_t = array_unique($dobne_t);
            sort($dobne_t);
            $dobne_j = array_unique($dobne_j);
            $dobne_o = array_unique($dobne_o);
            $dobne_s = array_unique($dobne_s);
            $dobne_m = array_unique($dobne_m);         
            sort($dobne_m);
            $dobne = array_merge($dobne_t,$dobne_j,$dobne_o,$dobne_s,$dobne_m);
                      
            return $dobne;
        }

        $unos = explode(',', $discipline);
        $meet_id = $unos[0];
        $disciplina = $unos[1]; 
        $results_m = Athlete::where('meet_id', $meet_id)->where('spol','M')->where('discipline', $disciplina)->join('results','results.athlete_id','=','athletes.id')->orderBy('total','DESC')->orderBy('weight')->get();
        $tezinske_m = tezkat($results_m);
        $dobne_m = dobkat($results_m);
       
        $results_f = Athlete::where('meet_id', $meet_id)->where('spol','Z')->where('discipline', $disciplina)->join('results','results.athlete_id','=','athletes.id')->orderBy('total','DESC')->orderBy('weight')->get();
        $tezinske_f = tezkat($results_f);
        $dobne_f = dobkat($results_f);
      return response()->json(['ispis'=>$disciplina,'rezultati_m'=>$results_m,'tezinske_m'=>$tezinske_m,'dobne_m'=>$dobne_m,'rezultati_f'=>$results_f,'tezinske_f'=>$tezinske_f,'dobne_f'=>$dobne_f,]);
    }
    public function relResList ($upit)
    {
        $unos = explode(',', $upit);

        $meet_id    = $unos[0];
        $disciplina = $unos[1];
        $kategorija = $unos[2];
        $spol       = $unos[3];

        switch ($kategorija)
        {
            case "TeensJuniors":
                $results = Athlete::where('meet_id', $meet_id)->where('spol',$spol)->where('discipline', $disciplina)->where('age','<','24')->join('results','results.athlete_id','=','athletes.id')->orderBy('age_points','DESC')->get();
                break;
            case "TeensAll":
                $results = Athlete::where('meet_id', $meet_id)->where('spol',$spol)->where('discipline', $disciplina)->where('age','<','20')->join('results','results.athlete_id','=','athletes.id')->orderBy('age_points','DESC')->get();
                break;
            case "MastersAll":
                $results = Athlete::where('meet_id', $meet_id)->where('spol',$spol)->where('discipline', $disciplina)->where('age','>','39')->join('results','results.athlete_id','=','athletes.id')->orderBy('age_points','DESC')->get();
                break;
            case "OverAll":
                $results = Athlete::where('meet_id', $meet_id)->where('spol',$spol)->where('discipline', $disciplina)->join('results','results.athlete_id','=','athletes.id')->orderBy('age_points','DESC')->get();
                break;
            default:
                $results = Athlete::where('meet_id', $meet_id)->where('spol',$spol)->where('discipline', $disciplina)->where('kategorijag',$kategorija)->join('results','results.athlete_id','=','athletes.id')->orderBy('points','DESC')->get();
                break;
       
        }
        if (empty($results))
          $results = "";
        return response()->json(['rezultati'=>$results]);
   

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
    public function inputWeight($datas)
    {
        $unos = explode(",",$datas);
        $id = $unos[0];
        $serija = $unos[1];
        $tezina =  $unos[2];
        if ($tezina == "-" || $tezina == "0")
         $tezina = 0.001;
        $rezultat = Result::find($id);
        $rezultat->$serija = $tezina;
        $rezultat->save();
        return response()->json(['rezultat'=>$tezina]);
    }
    public function inputLift($datas)
    {
        function isDone ($broj)
        {
        $decnumber = strlen(strstr($broj,'.'))-1;
        if (($broj < 0) || ($decnumber == 3))
         return true;
        else 
          return false;
        }
        
        function total ($result)
        {
           
            $squat = array();
            if (isDone($result->squat1))
             $squat[0] = $result->squat1;
             
            $squat[1] = $result->squat2;
            $squat[2] = $result->squat3;
            $squat_max = max($squat);
            if ($squat_max < 0)
               $squat_max = 0;

            $bench = array();
            if (isDone($result->bench1))
               $bench[0] = $result->bench1;
            $bench[1] = $result->bench2;
            $bench[2] = $result->bench3;
            $bench_max = max($bench);
            if ($bench_max < 0)
            $bench_max = 0;

            $deadlift = array();
            if (isDone($result->deadlift1))
             $deadlift[0] = $result->deadlift1;
            $deadlift[1] = $result->deadlift2;
            $deadlift[2] = $result->deadlift3;
            $deadlift_max = max($deadlift);
            if ($deadlift_max < 0)
            $deadlift_max = 0;

            $total = $squat_max + $bench_max + $deadlift_max;

            return $total;
        }
        $unos = explode("-",$datas);
        $lift = $unos[0];
        $id = $unos[1];
        $tezina =  $unos[2];
        $serija =  $unos[3];
        $rezultat = Result::find($id);
        if ($lift == "yes")
         $tezina = $tezina + 0.001;
        else
         $tezina = $tezina * (-1);
        $rezultat->$serija = $tezina;
        $rezultat->save();
        $koeficijent = $rezultat->athlete->weight_coef;
        $dobni_koeficijent = $rezultat->athlete->age_coef;
        $rezultat->total = total($rezultat);
        $rezultat->points = total($rezultat)*$koeficijent;
        $rezultat->age_points = total($rezultat)*$koeficijent*$dobni_koeficijent;
        $rezultat->save();


        //return response()->json();
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
    public function exportCSV($id)
{
    function zaokruzi ($broj)
    {
        if ($broj > 0)
         $broj = round($broj,2);
        elseif ($broj == 0)
        $broj = ""; // ovo treba doraditi za propušteni lift
       return $broj; 
    }
    
    $fileName = 'entries.csv';

    $headers = array(
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    );
    $columns = array('Place','Name', 'Sex', 'Event', 'Division','WeightClassKg','Equipment','Age','State','BodyweightKg',
    'Squat1Kg','Squat2Kg','Squat3Kg','Best3SquatKg','Bench1Kg','Bench2Kg','Bench3Kg','Best3BenchKg',
    'Deadlift1Kg','Deadlift2Kg','Deadlift3Kg','Best3DeadliftKg','TotalKg');
    
    $results = Athlete::where('meet_id', $id)->join('results','results.athlete_id','=','athletes.id')->orderBy('total','DESC')->orderBy('weight')->get();
    
    /*return $results;
    exit;  */ 
      $callback = function() use($results, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);
    
    foreach ($results as $rezultat) 
     {
        $row['Place'] = '';
        $name = $rezultat->name.' '.$rezultat->surname;
        $row['Name'] = $name;
       
        if ($rezultat->spol == "Z")
         $sex = "F";
        else
         $sex = "M";
    
       
        $row['Sex'] = $sex;

        $disciplina = explode(" ",$rezultat->discipline);
        $nastup = strtoupper($disciplina[1]);
        $event = $nastup[0];
        if ($event == "P")  // ovdje treba ubaciti provjeru za push&pull
          $event = "SBD";
        $equipment = $disciplina[0];
        if ($equipment == "Raw")
         $equipment = "Raw";
        else 
         $equipment = "Multi-ply";

         $row['Event'] = $event;
         $row['Division'] = $rezultat->kategorijag;
         $row['WeightClassKg'] = $rezultat->kategorijat;
         $row['Equipment'] = $equipment;
         $row['Age'] = $rezultat->age;
         $row['State'] = $rezultat->nomination->drzava;
         $row['BodyweightKg'] = $rezultat->weight;

         if ($event == "SBD")
         {
            // Ispis za čučanj
            $squat = array();
            $squat[0] = $rezultat->squat1;
            $squat[1] = $rezultat->squat2;
            $squat[2] = $rezultat->squat3;
            $squat_max = max($squat);
                 
            $row['Squat1Kg'] = zaokruzi($rezultat->squat1);
            $row['Squat2Kg'] = zaokruzi($rezultat->squat2);
            $row['Squat3Kg'] = zaokruzi($rezultat->squat3);
            if ($squat_max > 0) 
                $row['Best3SquatKg'] = zaokruzi($squat_max);
            else
                $row['Best3SquatKg'] = ""; // ovo treba urediti za bombout
            
            // Ispis za bench press
            $bench = array();
            $bench[0] = $rezultat->bench1;
            $bench[1] = $rezultat->bench2;
            $bench[2] = $rezultat->bench3;
            $bench_max = max($bench);
                 
            $row['Bench1Kg'] = zaokruzi($rezultat->bench1);
            $row['Bench2Kg'] = zaokruzi($rezultat->bench2);
            $row['Bench3Kg'] = zaokruzi($rezultat->bench3);
            if ($bench_max > 0) 
                $row['Best3BenchKg'] = zaokruzi($bench_max);
            else
                $row['Best3BenchKg'] = ""; // ovo treba urediti za bombput
            // Ispis za deadlift
            $deadlift = array();
            $deadlift[0] = $rezultat->deadlift1;
            $deadlift[1] = $rezultat->deadlift2;
            $deadlift[2] = $rezultat->deadlift3;
            $deadlift_max = max($deadlift);
                 
            $row['Deadlift1Kg'] = zaokruzi($rezultat->deadlift1);
            $row['Deadlift2Kg'] = zaokruzi($rezultat->deadlift2);
            $row['Deadlift3Kg'] = zaokruzi($rezultat->deadlift3);
            if ($deadlift_max > 0) 
                $row['Best3DeadliftKg'] = zaokruzi($deadlift_max);
            else
                $row['Best3DeadliftKg'] = ""; // ovo treba urediti za bombput
         }
         elseif ($event == "B")
         {
                                      
                  $row['Squat1Kg'] = "";
                  $row['Squat2Kg'] = "";
                  $row['Squat3Kg'] = "";
                  $row['Best3SquatKg'] = "";
          
                  
                  // Ispis za bench press
                  $bench = array();
                  $bench[0] = $rezultat->bench1;
                  $bench[1] = $rezultat->bench2;
                  $bench[2] = $rezultat->bench3;
                  $bench_max = max($bench);
                       
                  $row['Bench1Kg'] = zaokruzi($rezultat->bench1);
                  $row['Bench2Kg'] = zaokruzi($rezultat->bench2);
                  $row['Bench3Kg'] = zaokruzi($rezultat->bench3);
                  if ($bench_max > 0) 
                      $row['Best3BenchKg'] = zaokruzi($bench_max);
                  else
                      $row['Best3BenchKg'] = ""; // ovo treba urediti za bombout
                
                      $row['Deadlift1Kg'] = "";
                      $row['Deadlift2Kg'] = "";
                      $row['Deadlift3Kg'] = "";
                      $row['Best3DeadliftKg'] = "";
    
         }
         elseif ($event == "D")
         {
                                      
                  $row['Squat1Kg'] = "";
                  $row['Squat2Kg'] = "";
                  $row['Squat3Kg'] = "";
                  $row['Best3SquatKg'] = "";

                  $row['Bench1Kg'] = "";
                  $row['Bench2Kg'] = "";
                  $row['Bench3Kg'] = "";
                  $row['Best3BenchKg'] = "";
          
                  
                  // Ispis za bench press
                  $deadlift = array();
                  $deadlift[0] = $rezultat->deadlift1;
                  $deadlift[1] = $rezultat->deadlift2;
                  $deadlift[2] = $rezultat->deadlift3;
                  $deadlift_max = max($deadlift);
                       
                  $row['Deadlift1Kg'] = zaokruzi($rezultat->deadlift1);
                  $row['Deadlift2Kg'] = zaokruzi($rezultat->deadlift2);
                  $row['Deadlift3Kg'] = zaokruzi($rezultat->deadlift3);
                  if ($deadlift_max > 0) 
                      $row['Best3DeadliftKg'] = zaokruzi($deadlift_max);
                  else
                      $row['Best3DeadliftKg'] = ""; // ovo treba urediti za bombout            
         }
          // DOPISATI OPCIJU ZA PUSH&PULL I SQUAT ONLY //
          $total = $rezultat->total;  
          if ($total > 0) 
          $row['TotalKg'] = zaokruzi($total);
      else
          $row['TotalKg'] = ""; // ovo treba urediti za bombout   

    
       fputcsv($file, array($row['Place'],$row['Name'], $row['Sex'], $row['Event'],$row['Division'],$row['WeightClassKg'],
       $row['Equipment'],$row['Age'],$row['State'],$row['BodyweightKg'],
       $row['Squat1Kg'],$row['Squat2Kg'],$row['Squat3Kg'],$row['Best3SquatKg'],
       $row['Bench1Kg'],$row['Bench2Kg'],$row['Bench3Kg'],$row['Best3BenchKg'],
       $row['Deadlift1Kg'],$row['Deadlift2Kg'],$row['Deadlift3Kg'],$row['Best3DeadliftKg'],$row['TotalKg']));
     
     } 
     fclose($file);
    };
     
    return response()->stream($callback, 200, $headers);

    }

}
