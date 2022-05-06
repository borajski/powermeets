@extends('back_layouts.back-master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
<h3 class="text-center mb-4 mt-3"><strong>NATJECANJA</strong></h3>
<div class="row pt-3 mt-3">
<div class="col-md-6">
@foreach ($discipline as $disciplina)
<p class="text-center">
<button type="submit" class="btn btn-primary gumb m-1" style="width:14rem;" onclick="getGroups('{{$meet.','.$disciplina}}')">
    {{$disciplina}}</button></p>
    
@endforeach
</div>
<div class="col-md-6">
<div id="lista"></div>
</div>
</div>
</div>
</div>
@endsection
@section('js_after')
<script src="{{asset('js/back/competitions.js')}}" defer></script>
@endsection