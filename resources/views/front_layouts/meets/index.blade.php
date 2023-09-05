@extends('front_layouts.front-master')
@section('content')
@php
function ispisiDatum($datum)
{
return Carbon\Carbon::parse($datum)->format('d.m.Y');
}
@endphp
<div class="container vh-100">
    <div class="row">
        <div class="col-md-10 offset-md-1">
<h4>Ended competitions</h4>
<p>&nbsp;</p>
<div class="table-responsive-sm">
<table class="table table-hover bg-light shadow">
  <thead class="thead t-head" >
    <tr>
      <th>{{ __('Name') }}</th>
      <th>{{ __('Federation') }}</th>
      <th>{{ __('Venue') }}</th>
      <th>{{ __('Date') }}</th>     
    </tr>
  </thead>
  <tbody>
@foreach($natjecanja as $natjecanje)
@if (($natjecanje->gensetts->rezultati == 'on') &&  ($natjecanje->gensetts->aktivan != 'on'))
    <tr>
       <td><a href="meet/{{ $natjecanje->id }}"> {{$natjecanje->naziv}}</a></td>
      <td>  {{$natjecanje->federation->name}}</td>
      <td>{{ $natjecanje->mjesto}}</td>
      <td>{{ispisiDatum($natjecanje->datump)}}</td>
         
    </tr>
  @endif
@endforeach
  </tbody>
</table>
</div>
</div>
</div>
</div>
@endsection