@extends('back_layouts.back-master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h2 class="text-center mb-4">{{$meet->naziv}}</h2>
            <h3 class="mb-3"><strong>{{ __('Lista prijavljenih') }}</strong></h3>
            @foreach ($division as $divizija)
            <h3><strong> {{$divizija}}</strong></h3>
            @foreach ($discipline_meet as $single)
            @if ((substr($divizija,0,2)) == substr($single,0,2))
            <button type="submit" class="btn btn-primary"
                onclick="getNominations('{{$meet->id.','.$single}}')">{{$single}}</button>
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
        <script src="{{asset('js/back/meet.js')}}" defer></script>
        @endsection