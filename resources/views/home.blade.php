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
<!--aktualna natjecanja-->
<div class="row py-3">
        <div class="col-md-10 offset-md-1">
<h4><strong>{{ __('AKTUALNA NATJECANJA') }}</strong></h4>
<div class="table-responsive-sm pt-4">
<table class="table table-hover bg-light shadow">
  <thead class="thead t-head" >
    <tr>
    <th>{{ __('Naziv') }}</th>
      <th>{{ __('Prijavljeni') }}</th>
      <th>{{ __('Organiziraj') }}</th>
      <th>{{ __('Natjecanje') }}</th>
      <th>{{ __('Rezultati') }}</th>
     </tr>
  </thead>
  <tbody>
@foreach($natjecanja as $natjecanje)
@if (($natjecanje->gensetts->rezultati != 'on') &&  ($natjecanje->gensetts->aktivan == 'on'))
<tr>
       <td><a href="{{ route('meets.show', $natjecanje->id)}}"> {{$natjecanje->naziv}}</a></td>
      <td class="text-center"><a href="{{ route('nominations.show', $natjecanje->id)}}"><i class="fa-solid fa-table-list fa-lg"></i></a></td>
      @if ($natjecanje->gensetts->prijavnica != 'on') 
      <td class="text-center">      
      <a href="{{ route('athletes.show', $natjecanje->id)}}"><i class="fa-solid fa-gear fa-lg"></i></a>
      </td>
      <td class="text-center">      
      <a href="{{ route('results.show', $natjecanje->id)}}"><i class="fa-solid fa-dumbbell"></i></a>
      </td>
      <td class="text-center">
      <a href="competition_results/{{ $natjecanje->id }}">  
      <i class="fa-solid fa-square-poll-horizontal fa-lg"></i></td>
      @else 
      <td class="text-center">   
      <i class="fa-solid fa-gear fa-lg"></i>
      </td>
      <td class="text-center">   
      <i class="fa-solid fa-dumbbell"></i>
      </td>
      <td class="text-center"><i class="fa-solid fa-square-poll-horizontal fa-lg"></i></td>
      @endif 
   </tr>
       @endif 
@endforeach
  </tbody>
</table>
</div>
</div>
</div>
<!--održana natjecanja-->
<div class="row pt-5">
        <div class="col-md-10 offset-md-1">
<h4><em>{{ __('ODRŽANA NATJECANJA') }}</em></h4>
<div class="table-responsive-sm pt-4">
<table class="table table-hover bg-light shadow">
  <thead class="thead t-head" >
    <tr>
      <th>{{ __('Naziv') }}</th>
      <th>{{ __('Federacija') }}</th>
      <th>{{ __('Mjesto') }}</th>
      <th>{{ __('Datum') }}</th>
      <th>{{ __('Rezultati') }}</th>
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