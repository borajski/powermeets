@extends('front_layouts.front-master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
<h4>Natjecanja</h4>
<div class="table-responsive-sm">
<table class="table table-hover bg-light shadow">
  <thead class="thead t-head" >
    <tr>
      <th>ID</th>
      <th>Naziv</th>
      <th>Organizator</th>
      <th>Federacija</th>
      <th>Početak</th>
      <th>Završetak</th>      
    </tr>
  </thead>
  <tbody>
@foreach($natjecanja as $natjecanje)
    <tr>
      <td>{{$natjecanje->id}}</td>
       <td><a href="meet/{{ $natjecanje->id }}"> {{$natjecanje->naziv}}</a></td>
      <td>{{ $natjecanje->organizator }}</td>
      <td>{{ $natjecanje->federacija }}</td>
      <td>{{ $natjecanje->datump }}</td>
      <td>{{ $natjecanje->datumk }}</td>      
    </tr>
@endforeach
  </tbody>
</table>
</div>
</div>
</div>
</div>
@endsection