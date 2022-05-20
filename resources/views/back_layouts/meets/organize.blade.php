@extends('back_layouts.back-master')
@section('content')
@php
$nominations = $meet->nominations;
$ima = false;
foreach ($nominations as $nominacija)
{
if (count($nominacija->athletes) > 0) {
$ima = true;
break;
}
}
@endphp
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 pb-4">

            <h2 class="text-center p-3 mb-4"><strong>{{$meet->naziv}}</strong></h2>
            <h3 class="text-center mt-3 mb-5">{{ __('Meet Management') }}</h3>
       
                @if ($ima)
                <button type="button" class="btn btn-secondary m-1" disabled>{{ __('Started') }}</button>
                           <!--Accordion-->
            <div class="accordion" id="meetmanaging">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#groups" aria-expanded="false" aria-controls="groups">
                            {{ __('Grouping') }}
                        </button>
                    </h2>
                    <div id="groups" class="accordion-collapse collapse" data-bs-parent="#meetmanaging">
                        <div class="accordion-body">
                            <div class="col">
                                <h3 class="text-center mt-3 mb-5">{{ __('Flights Groupping') }}</h3>
                                @foreach ($division as $divizija)
                                <h4 class="mt-2 mb-2"><strong> {{$divizija}}</strong></h4>
                                @foreach ($discipline_meet as $single)
                                @if ((substr($divizija,0,2)) == substr($single,0,2))
                                @php
                                $disc = explode("-",$single);
                                $single_disc = $divizija.' '.$disc[1];
                                $disciplina = ucfirst($disc[1]);
                                @endphp
                                <button type="submit" class="btn btn-primary gumb m-1"
                                    onclick="getFlights('{{$meet->id.','.$single_disc}}')">{{$disciplina}}</button>
                                @endif
                                @endforeach
                                @endforeach
                                <div class="table-responsive-sm mt-4 p-2">
                                    <form enctype="multipart/form-data" action="/group" method="POST">
                                        {{ csrf_field() }}
                                        <div id="lista"></div>
                                    </form>
                                    <div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flights" aria-expanded="false" aria-controls="flights">
                            {{ __('Flights') }}
                        </button>
                    </h2>
                    <div id="flights" class="accordion-collapse collapse" data-bs-parent="#meetmanaging">
                        <div class="accordion-body">
                            <div class="col">
                                <h3 class="text-center mt-3 mb-5">{{ __('Flight Groups') }}</h3>
                                @foreach ($division as $divizija)
                                <h4 class="mt-2 mb-2"><strong> {{$divizija}}</strong></h4>
                                @foreach ($discipline_meet as $single)
                                @if ((substr($divizija,0,2)) == substr($single,0,2))
                                @php
                                $disc = explode("-",$single);
                                $single_disc = $divizija.' '.$disc[1];
                                $disciplina = ucfirst($disc[1]);
                                @endphp
                                <button type="submit" class="btn btn-primary gumb m-1"
                                    onclick="getGroups('{{$meet->id.','.$single_disc}}')">{{$disciplina}}</button>
                                @endif
                                @endforeach
                                @endforeach
                                <div class="table-responsive-sm mb-4 mt-4 p-2">
                                    <div id="lista2"></div>
                                                                   </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#weighing" aria-expanded="false" aria-controls="weighing">
                            {{ __('Weighing') }}
                        </button>
                    </h2>
                    <div id="weighing" class="accordion-collapse collapse" data-bs-parent="#meetmanaging">
                        <div class="accordion-body">
                            <div class="col">
                                <h3 class="text-center mt-3 mb-5">{{ __('Weighing') }}</h3>
                                @foreach ($division as $divizija)
                                <h4 class="mt-2 mb-2"><strong> {{$divizija}}</strong></h4>
                                @foreach ($discipline_meet as $single)
                                @if ((substr($divizija,0,2)) == substr($single,0,2))
                                @php
                                $disc = explode("-",$single);
                                $single_disc = $divizija.' '.$disc[1];
                                $disciplina = ucfirst($disc[1]);
                                @endphp
                                <button type="submit" class="btn btn-primary gumb m-1"
                                    onclick="weighing('{{$meet->id.','.$single_disc}}')">{{$disciplina}}</button>
                                @endif
                                @endforeach
                                @endforeach

                                <div class="table-responsive-sm mt-4 p-2">
                                    <div id="lista4"></div>

                                    <div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#racks" aria-expanded="false" aria-controls="racks">
                            {{ __('Rack heights') }}
                        </button>
                    </h2>
                    <div id="racks" class="accordion-collapse collapse" data-bs-parent="#meetmanaging">
                        <div class="accordion-body">
                            <div class="col">
                                <h3 class="text-center mt-3 mb-5">{{ __('Rack Heights') }}</h3>
                                @foreach ($division as $divizija)
                                <h4 class="mt-2 mb-2"><strong> {{$divizija}}</strong></h4>
                                @foreach ($discipline_meet as $single)
                                @if ((substr($divizija,0,2)) == substr($single,0,2))
                                @php
                                $disc = explode("-",$single);
                                $single_disc = $divizija.' '.$disc[1];
                                $disciplina = ucfirst($disc[1]);
                                @endphp
                                @if ($disc[1] != "deadlift")
                                <button type="submit" class="btn btn-primary gumb m-1"
                                    onclick="rackHeights('{{$meet->id.','.$single_disc}}')">{{$disciplina}}</button>
                                @endif
                                @endif
                                @endforeach
                                @endforeach

                                <div class="table-responsive-sm mt-4 p-2">
                                    <form enctype="multipart/form-data" action="/setrack" method="POST">
                                        {{ csrf_field() }}
                                        <div id="lista3"></div>

                                    </form>
                                    <div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--kraj accordiona-->
               
                @else
                <a role="button" class="btn btn-primary gumb m-1"
                    href="/start_managing/{{$meet->id}}">{{ __('Start') }}</a>
                @endif

         
        </div>

    </div>
    @endsection
    @section('js_after')
    <script src="{{asset('js/back/flights.js')}}" defer></script>
    @endsection