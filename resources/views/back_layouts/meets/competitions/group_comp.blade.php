@extends('back_layouts.back-master')
@section('content')
@php
$upit1 = $prefix[1];
$upit2 = $prefix[2];
$upit3 = $prefix[3];
$upit4 = $prefix[4];
$serija = substr($aktivna, -1);

function lift ($broj)
{
 if ($broj < 0)
   return 'redcell';
$decnumber = strlen(strstr($broj,'.'))-1;
if ($decnumber == 3)
return 'greencell';
else 
   return "";
}
function aktivna ($broj,$aktivna)
{
  $serija = substr($aktivna, -1);
 if ($broj == $serija)
   return 'activecell';
 else
   return '';
}

@endphp
<div class="container">
<div class="row">
        <div class="col-md-10 offset-md-1">
          <h2 class="text-center">PLATFORMA</h2>
          <div id="stage" style="background-color: yellow;"></div>
          <div class="mt-4 text-center">
  <a role="button" class="btn btn-success" id="goodLift" onclick="liftResult(this.value)">Good lift</a>
  <a role="button" class="btn btn-danger" id="noLift" onclick="liftResult(this.value)">No lift</a></div>
</div>
</div>
    <div class="row">
        <div class="col-md-10 offset-md-1">
<h3 class="text-center mb-4 mt-3"><strong>NATJECANJA</strong></h3>
<h4 class="text-center mb-4 mt-3"><strong>Disciplina:{{$disciplina}}-Grupa:{{$grupa}}</strong></h4>
<div class="table-responsive-sm">
<table class="table table-hover bg-light shadow">
<thead class="thead t-head" >
    <tr>
      <th>{{ __('Athlete') }}</th>
      <th>{{ __('BWT') }}</th>
      <th>{{ __('Age') }}</th>
      <th class="{{aktivna(1,$aktivna)}}">{{ $prefix[0]}}1</th>
      <th class="{{aktivna(2,$aktivna)}}">{{ $prefix[0]}}2</th>
      <th class="{{aktivna(3,$aktivna)}}">{{ $prefix[0]}}3</th>
      <th class="{{aktivna(4,$aktivna)}}">{{ $prefix[0]}}4</th>    
      <th>{{ __('Total') }}</th>
      <th>{{ __('Points') }}</th>
    </tr>
  </thead><div id="ispis">
  <tbody>
  
@foreach ($slijedeci as $natjecatelj)
<tr>
<td><a href="#" class="" onclick="onStage({{$natjecatelj}},{{$natjecatelj->$aktivna}},'{{$aktivna}}')">{{$natjecatelj->name}}&nbsp;{{$natjecatelj->surname}}</a></td>
<td>{{$natjecatelj->weight}}</td>
<td>{{$natjecatelj->age}}</td>
<!--prva serija-->
<td class="{{lift($natjecatelj->$upit1)}}">
@if ($aktivna == $upit1)
<b id="{{$natjecatelj->id.$upit1}}" ondblclick="promjena({{$natjecatelj->id}},'{{$upit1}}')">
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
<b id="{{$natjecatelj->id.$upit2}}" ondblclick="promjena({{$natjecatelj->id}},'{{$upit2}}')">
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
<b id="{{$natjecatelj->id.$upit3}}" ondblclick="promjena({{$natjecatelj->id}},'{{$upit3}}')">
@else
<b>
@endif
@if (abs(round($natjecatelj->$upit3,1)) != 0)
  {{abs(round($natjecatelj->$upit3,1))}}
</b>
@endif
</td>
<!--kraj treće serije-->
<!--četvrta serija-->
<td class="{{lift($natjecatelj->$upit4)}}">
@if ($aktivna == $upit4)
<b id="{{$natjecatelj->id.$upit4}}" ondblclick="promjena({{$natjecatelj->id}},'{{$upit4}}')">
@else
<b>
@endif
@if (abs(round($natjecatelj->$upit4,1)) != 0)
  {{abs(round($natjecatelj->$upit4,1))}}
</b>
@endif
</td>
<!--kraj četvrte serije-->
<td>{{$natjecatelj->total}}</td>
<td>{{$natjecatelj->points}}</td>
</tr>
@endforeach
@foreach ($odradili as $natjecatelj)
<tr>
<td>{{$natjecatelj->name}}&nbsp;{{$natjecatelj->surname}}</td>
<td>{{$natjecatelj->weight}}</td>
<td>{{$natjecatelj->age}}</td>
<!--prva serija-->
<td class="{{lift($natjecatelj->$upit1)}}">{{abs(round($natjecatelj->$upit1,1))}}</td>
<!--kraj prve serije-->
<!--druga serija-->
<td class="{{lift($natjecatelj->$upit2)}}">
<div id="{{$natjecatelj->id.$upit2}}">
@if ((($serija + 1) == 2) && ($natjecatelj->$upit2 == NULL))
<input type='text' size='5' maxlength='5' onchange="weightUpdate({{$natjecatelj->id}},'{{$upit2}}',this.value)">
</div> 
@else
@if (abs(round($natjecatelj->$upit2,1)) != 0)
  {{abs(round($natjecatelj->$upit2,1))}}
@endif
@endif
</td>
<!--kraj druge serije-->
<!--treća serija-->
<td class="{{lift($natjecatelj->$upit3)}}">
<div id="{{$natjecatelj->id.$upit3}}">
@if ((($serija + 1) == 3) && ($natjecatelj->$upit3 == NULL))
<input type='text' size='5' maxlength='5' onchange="weightUpdate({{$natjecatelj->id}},'{{$upit3}}',this.value)">
</div> 
@else
@if (abs(round($natjecatelj->$upit3,1)) != 0)
  {{abs(round($natjecatelj->$upit3,1))}}
@endif
@endif
</td>
<!--kraj treće serije-->
<!--četvrta serija-->
<td class="{{lift($natjecatelj->$upit4)}}">
<div id="{{$natjecatelj->id.$upit4}}">
@if ((($serija + 1) == 4) && ($natjecatelj->$upit4 == NULL))
<input type='text' size='5' maxlength='5' onchange="weightUpdate({{$natjecatelj->id}},'{{$upit4}}',this.value)">
</div> 
@else
@if (abs(round($natjecatelj->$upit4,1)) != 0)
  {{abs(round($natjecatelj->$upit4,1))}}
@endif
@endif
</td>
<!--kraj treće serije-->
<td>{{$natjecatelj->total}}</td>
<td>{{$natjecatelj->points}}</td>
</tr>
@endforeach
  
</tbody></div>
</table>

<div class="mt-4 text-end"><button type="submit" class="btn btn-primary gumb" onclick="nextSerie()">Start</button></div>


</div>
</div>
</div>
</div>
@endsection
@section('js_after')
<script src="{{asset('js/back/competitions.js')}}" defer></script>
@endsection