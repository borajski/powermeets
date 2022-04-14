@extends('back_layouts.back-master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h2 class="text-center p-3 mb-4"><strong>{{$meet->naziv}}</strong></h2>
            <h3 class="text-center mt-3 mb-5">{{ __('Nominations') }}</h3>
            @foreach ($division as $divizija)
            <h4 class="mt-2 mb-2"><strong> {{$divizija}}</strong></h4>
            @foreach ($discipline_meet as $single)
            @if ((substr($divizija,0,2)) == substr($single,0,2))
            @php 
            $disc = explode("-",$single);
            $disciplina = ucfirst($disc[1]);
            @endphp
            <button type="submit" class="btn btn-primary gumb m-1"
                onclick="getNominations('{{$meet->id.','.$single}}')">{{$disciplina}}</button>
            @endif
            @endforeach
            @endforeach
            <div class="table-responsive-sm mt-4 p-2">
                <div id="lista"></div>
                <div>
                </div>
            </div>
        </div>
        @endsection
        @section('js_after')
        <script src="{{asset('js/back/nominations.js')}}" defer></script>
        @endsection