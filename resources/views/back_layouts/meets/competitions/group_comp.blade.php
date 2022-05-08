@extends('back_layouts.back-master')
@section('content')
@php
$upit1 = $prefix[1];
$upit2 = $prefix[2];
$upit3 = $prefix[3];
$upit4 = $prefix[4];

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

@endphp
<div class="container">
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
      <th>{{ $prefix[0]}}1</th>
      <th>{{ $prefix[0]}}2</th>
      <th>{{ $prefix[0]}}3</th>
      <th>{{ $prefix[0]}}4</th>    
      <th>{{ __('Total') }}</th>
      <th>{{ __('Points') }}</th>
    </tr>
  </thead><div id="ispis">
  <tbody>
  
@foreach ($slijedeci as $natjecatelj)
<tr>
<td>{{$natjecatelj->name}}&nbsp;{{$natjecatelj->surname}}</td>
<td>{{$natjecatelj->weight}}</td>
<td>{{$natjecatelj->age}}</td>
<td class="{{lift($natjecatelj->$upit1)}}">{{abs(round($natjecatelj->$upit1,1))}}</td>
<td>{{$natjecatelj->$upit2}}</td>
<td>{{$natjecatelj->$upit3}}</td>
<td>{{$natjecatelj->$upit4}}</td>
<td>{{$natjecatelj->total}}</td>
<td>{{$natjecatelj->points}}</td>
</tr>
@endforeach
@foreach ($odradili as $natjecatelj)
<tr>
<td>{{$natjecatelj->name}}&nbsp;{{$natjecatelj->surname}}</td>
<td>{{$natjecatelj->weight}}</td>
<td>{{$natjecatelj->age}}</td>
<td class="{{lift($natjecatelj->$upit1)}}">{{abs(round($natjecatelj->$upit1,1))}}</td>
<td>{{$natjecatelj->$upit2}}</td>
<td>{{$natjecatelj->$upit3}}</td>
<td>{{$natjecatelj->$upit4}}</td>
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