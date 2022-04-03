@extends('back_layouts.back-master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h2 class="text-center p-3 mb-4"><strong>{{$meet->naziv}}</strong></h2>
            <h3 class="text-center mt-3 mb-5">{{ __('Meet Management') }}</h3>
            @if ($meet->athletes)
            <button type="button" class="btn btn-secondary m-1" disabled>{{ __('Started') }}</button>
            @else
            <a role="button" class="btn btn-primary gumb m-1"
                href="/start_managing/{{$meet->id}}">{{ __('Start') }}</a>
            @endif
        
                </div>
            </div>
        
        </div>
        @endsection
       