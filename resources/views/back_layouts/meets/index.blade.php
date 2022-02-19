@extends('back_layouts.back-master')
@section('content')
@php 
function ispisiDatum($datum)
{
    return  Carbon\Carbon::parse($datum)->format('d.m.Y');
}
@endphp
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
<h4>Natjecanja</h4>
<div class="table-responsive-sm">
<table class="table table-hover bg-light shadow">
  <thead class="thead t-head" >
    <tr>
      <th>{{ __('Naziv') }}</th>
      <th>{{ __('Prijavljeni') }}</th>
      <th>{{ __('Federacija') }}</th>
      <th>{{ __('Početak') }}</th>
      <th>{{ __('Kraj') }}</th>
      <th>{{ __('Obriši') }}</th>
    </tr>
  </thead>
  <tbody>
@foreach($natjecanja as $natjecanje)
    <tr>
       <td><a href="{{ route('meets.show', $natjecanje->id)}}"> {{$natjecanje->naziv}}</a></td>
      <td><a href="{{ route('nominations.show', $natjecanje->id)}}"><i class="fa-solid fa-table-list fa-lg"></i></a></td>
      <td>{{ $natjecanje->federation->name}}</td>
      <td>{{ ispisiDatum($natjecanje->datump) }}</td>
      <td>{{ ispisiDatum($natjecanje->datumk) }}</td>      
      <td><a href="delete/{{ $natjecanje->id }}"><i class="fa-solid fa-trash-can fa-lg"></i></a></td>
    </tr>
@endforeach
  </tbody>
</table>
</div>
</div>
</div>
</div>
@endsection