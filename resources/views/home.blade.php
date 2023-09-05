@extends('back_layouts.back-master')
@section('content')
@php
function ispisiDatum($datum)
{
return Carbon\Carbon::parse($datum)->format('d.m.Y');
}
@endphp
<p>
@if (!(auth()->user()->details))
<h4 class="text-center"><strong>Za potpuno korištenje platforme molimo vas uredite <a href="/profile" style="color:blue;">vaše korisničke podatke</a>!</strong></h4>
@endif
</p>
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
<h4>Održana natjecanja</h4>
<div class="table-responsive-sm">
<table class="table table-hover bg-light shadow">
  <thead class="thead t-head" >
    <tr>
      <th>{{ __('Naziv') }}</th>
      <th>{{ __('Federacija') }}</th>
      <th>{{ __('Mjesto') }}</th>
      <th>{{ __('Datum') }}</th>
      <th>{{ __('Rezultati') }}</th>
      <th>{{ __('Obriši') }}</th>
    </tr>
  </thead>
  <tbody>
@foreach($natjecanja as $natjecanje)
@if (($natjecanje->gensetts->rezultati == 'on') &&  ($natjecanje->gensetts->aktivan != 'on'))
    <tr>    
       <td><a href="{{ route('meets.show', $natjecanje->id)}}"> {{$natjecanje->naziv}}</a></td>
      <td class="text-center">
      {{$natjecanje->federation->name}}  </td>
     
      <td class="text-center">      
      {{$natjecanje->mjesto}}  </td>
      <td class="text-center">      
      {{ispisiDatum($natjecanje->datump)}} </td>
      <td class="text-center">
      <a href="competition_results/{{ $natjecanje->id }}">  
      <i class="fa-solid fa-square-poll-horizontal fa-lg"></i></td>
     
      <td class="text-center"><a href="delete/{{ $natjecanje->id }}" onclick="return confirm('Are you sure you want to Remove?');"><i class="fa-solid fa-trash-can fa-lg"></i></a></td>
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