@extends('back_layouts.back-master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 pb-4">
            <h2 class="text-center p-3 mb-4"><strong>{{$meet->naziv}}</strong></h2>
            <h3 class="text-center mt-3 mb-5">{{ __('Meet Management') }}</h3>
            @if (count($meet->athletes) > 0)
            <button type="button" class="btn btn-secondary m-1" disabled>{{ __('Started') }}</button>
            <a role="button" class="btn btn-primary gumb m-1" href="#groups"
                data-bs-toggle="collapse">{{ __('Grouping') }}</a>
                <a role="button" class="btn btn-primary gumb m-1" href="#flights"
                data-bs-toggle="collapse">{{ __('Flights') }}</a>
                <a role="button" class="btn btn-primary gumb m-1" href="#racks"
                data-bs-toggle="collapse">{{ __('Rack heights') }}</a>
            @else
            <a role="button" class="btn btn-primary gumb m-1" href="/start_managing/{{$meet->id}}">{{ __('Start') }}</a>
            @endif

        </div>
        <!--- division za određivanje grupa -->
        <div class="collapse" id="groups">
            <div class="card card-body">
                <div class="col-md-10 offset-md-1">
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
         <!--- kraj divisiona za određivanje grupa -->
         <!--- division za ispisivanje grupa -->
        <div class="collapse" id="flights">
            <div class="card card-body">
                <div class="col-md-10 offset-md-1">
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

                    <div class="table-responsive-sm mt-4 p-2">
                               
                            <div id="lista2"></div>

                        </form>
                        <div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
         <!--- kraj divisiona za ispisivanje grupa -->
          <!--- division za visine stalaka -->
          <div class="collapse" id="racks">
            <div class="card card-body">
                <div class="col-md-10 offset-md-1">
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
         <!--- kraj divisiona za ispisivanje grupa -->
    </div>

</div>
@endsection
@section('js_after')
<script src="{{asset('js/back/flights.js')}}" defer></script>
@endsection