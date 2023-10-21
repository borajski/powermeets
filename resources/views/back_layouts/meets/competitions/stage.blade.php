@extends('back_layouts.back-stage-master')
@section('content')
@php
global $serija,$ostatak;
$upit1 = $prefix[1];
$upit2 = $prefix[2];
$upit3 = $prefix[3];
$serija = substr($aktivna, -1);
$ostatak = count($slijedeci);

if (str_contains($aktivna,"squat"))
$active_discipline = "Squat series";
if (str_contains($aktivna,"bench"))
$active_discipline = "Bench press series";
if (str_contains($aktivna,"deadlift"))
$active_discipline = "Deadlift series";

function lift ($broj)
{
if ($broj < 0) return 'redcell' ; $decnumber=strlen(strstr($broj,'.'))-1; if ($decnumber==3) return 'greencell' ; else
    return "" ; } function aktivna ($broj) { global $serija,$ostatak; if ($ostatak==0) return '' ; if ($broj==$serija)
    return 'activecell' ; else return '' ; } @endphp 
    <div class="container">
    <div class="row" id="to-stage">    
        <div class="row p-2">
            <div class="col-ms-3 platforma">
                <div id="boje"></div>
            </div>
            <div class="col-ms-3 platforma text-start">
               <div id="specifikacija"></div>
            </div>
            <div class="col-ms-3 platforma">
                <p>Rack height:</p>
                <div class="text-center" id="rack">&nbsp;</div>
            </div>
            <div class="col-ms-3 platforma" style="background-color: #000428;">
            <p class="text-center" id="timespan"></p>
             </div>
        </div>
        <div class="row">
         <div class="col">            
            <div class="p-5" id="stage">
            </div>
        </div>
       </div>
    </div>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="row kontrole mt-4 mb-4" id="kontrole">
                <div class="col-md-6">
                    <div class="text-end" id="gumbi"></div>
                </div>
                <div class="col-md-6 text-start">
                    <a role="button" class="btn btn-success" id="goodLift" onclick="liftResult(this.value)">Good
                        lift</a>
                    <a role="button" class="btn btn-danger" id="noLift" onclick="liftResult(this.value)">No lift</a>
                 </div>
              </div>
                           
            <div class="table-responsive-sm">
                <table class="table table-hover bg-dark text-light shadow">
                    <thead class="thead t-head">
                        <tr>
                            <th>{{ __('Athlete') }}</th>
                            <th>{{ __('BWT') }}</th>
                            <th>{{ __('Age') }}</th>
                            <th class="{{aktivna(1)}}">{{ $prefix[0]}}1</th>
                            <th class="{{aktivna(2)}}">{{ $prefix[0]}}2</th>
                            <th class="{{aktivna(3)}}">{{ $prefix[0]}}3</th>
                            <th>{{ __('Total') }}</th>
                            <th>{{ __('Points') }}</th>
                        </tr>
                    </thead>
                    <div id="ispis">
                        <tbody>

                            @foreach ($slijedeci as $natjecatelj)
                            <tr>
                                <td><a href="#" class="athlete-link"
                                        onclick="onStage({{$natjecatelj}},{{$natjecatelj->$aktivna}},'{{$aktivna}}','{{$bar}}','{{$collar}}')">{{$natjecatelj->name}}&nbsp;{{$natjecatelj->surname}}</a>
                                </td>
                                <td>{{$natjecatelj->weight}}</td>
                                <td>{{$natjecatelj->age}}</td>
                                <!--prva serija-->
                                <td class="{{lift($natjecatelj->$upit1)}}">
                                    @if ($aktivna == $upit1)
                                    <b id="{{$natjecatelj->id.$upit1}}"
                                        ondblclick="promjena({{$natjecatelj->id}},'{{$upit1}}')">
                                        @else
                                        <b>
                                            @endif
                                            {{abs(round($natjecatelj->$upit1,1))}}
                                        </b>
                                </td>
                                <!--kraj prve serije-->
                                <!--druga serija-->
                                <td class="{{lift($natjecatelj->$upit2)}}">
                                    @if ($aktivna == $upit2)
                                    <b id="{{$natjecatelj->id.$upit2}}"
                                        ondblclick="promjena({{$natjecatelj->id}},'{{$upit2}}')">
                                        @else
                                        <b>
                                            @endif
                                            @if (abs(round($natjecatelj->$upit2,1)) != 0)
                                            {{abs(round($natjecatelj->$upit2,1))}}
                                        </b>
                                        @endif
                                </td>
                                <!--kraj druge serije-->
                                <!--treća serija-->
                                <td class="{{lift($natjecatelj->$upit3)}}">
                                    @if ($aktivna == $upit3)
                                    <b id="{{$natjecatelj->id.$upit3}}"
                                        ondblclick="promjena({{$natjecatelj->id}},'{{$upit3}}')">
                                        @else
                                        <b>
                                            @endif
                                            @if (abs(round($natjecatelj->$upit3,1)) != 0)
                                            {{abs(round($natjecatelj->$upit3,1))}}
                                        </b>
                                        @endif
                                </td>
                                <!--kraj treće serije-->
                                <td>{{$natjecatelj->total}}</td>
                                <td>{{$natjecatelj->points}}</td>
                            </tr>
                            @endforeach
                                 </tbody>
                    </div>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
    @endsection
    @section('js_after')
    <script src="{{asset('js/back/competitions.js')}}" defer></script>
    @endsection