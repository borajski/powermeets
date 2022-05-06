@extends('back_layouts.back-master')
@section('content')
@php
if (strpos($disciplina,"bench"))
  {
      $prefix = "BP";
   $upit1 = "bench1";
   $upit2 = "bench2";
   $upit3 = "bench3";
   $upit4 = "bench4";
}
   
if (strpos($disciplina,"deadlift"))
   {
       $prefix = "DL";
       $upit1 = "deadlift1";
       $upit2 = "deadlift2";
   $upit3 = "deadlift3";
   $upit4 = "deadlift4";
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
      <th>{{ $prefix}}1</th>
      <th>{{ $prefix}}2</th>
      <th>{{ $prefix}}3</th>
      <th>{{ $prefix}}4</th>    
      <th>{{ __('Total') }}</th>
      <th>{{ __('Points') }}</th>
    </tr>
  </thead>
  <tbody>
@foreach ($natjecatelji as $natjecatelj)
<tr>
<td>{{$natjecatelj->name}}&nbsp;{{$natjecatelj->surname}}</td>
<td>{{$natjecatelj->weight}}</td>
<td>{{$natjecatelj->age}}</td>
@if ($natjecatelj->results)
<td>{{$natjecatelj->results->$upit1}}</td>
<td>{{$natjecatelj->results->$upit2}}</td>
<td>{{$natjecatelj->results->$upit3}}</td>
<td>{{$natjecatelj->results->$upit4}}</td>
<td>{{$natjecatelj->results->total}}</td>
<td>{{$natjecatelj->results->points}}</td>
@endif

</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
@endsection