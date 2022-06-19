@extends('back_layouts.back-master')
@section('content')
@php
function dobkat ($nomination)
{
$dobne = array();
$dobne_t = array();
$dobne_j = array();
$dobne_s = array();
$dobne_o = array();
$dobne_m = array();
foreach ($nomination as $nominacija) {
$age = $nominacija->kategorijag;
switch ($age[0])
{
case "T":
$dobne_t[] = $age;
break;
case "J":
$dobne_j[] = $age;
break;
case "S":
$dobne_s[] = $age;
break;
case "O":
$dobne_o[] = $age;
break;
case "M":
$dobne_m[] = $age;
break;
}

}
$dobne_t = array_unique($dobne_t);
sort($dobne_t);
$dobne_j = array_unique($dobne_j);
$dobne_s = array_unique($dobne_s);
$dobne_o = array_unique($dobne_o);
$dobne_m = array_unique($dobne_m);
sort($dobne_m);
$dobne = $dobne_t+$dobne_j+$dobne_o+$dobne_s+$dobne_m;
return $dobne;
}
$natjecatelji = $meet->athletes;
$dobne = dobkat($natjecatelji);
@endphp
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 pb-4">
            <h2 class="text-center p-3 mb-4"><strong>{{$meet->naziv}}</strong></h2>
            <h3 class="text-center mt-3 mb-5">{{ __('Results') }}</h3>
            <h4 class="text-start mt-3 mb-5">{{ __('Results by categories') }}</h4>
            @foreach ($discipline as $disciplina)
  
            @if (strpos($disciplina,"powerlifting"))
            <button type="submit" class="btn btn-primary gumb m-1"
                onclick="getFullResults('{{$meet->id.','.$disciplina}}')">{{$disciplina}}</button>
            @elseif (strpos($disciplina,"push"))
            <button type="submit" class="btn btn-primary gumb m-1"
                onclick="getPushResults('{{$meet->id.','.$disciplina}}')">{{$disciplina}}</button>
            @else
            <button type="submit" class="btn btn-primary gumb m-1"
                onclick="getResults('{{$meet->id.','.$disciplina}}')">{{$disciplina}}</button>
            @endif

            @endforeach
            <div class="table-responsive-sm mt-4 p-2">
                <div id="lista"></div>
            </div>
            <h4 class="text-start mt-3 mb-4">{{ __('Results by relative categories') }}</h4>
            <div class="row">
                <div class="col-md-4">
                    <select class="form-select" name="disciplina" id="disciplina">
                        <option selected>{{ __('Discipline') }}</option>
                        @foreach ($discipline as $disciplina)
                        <option value="{{$disciplina}}">{{$disciplina}}</option>
                        @endforeach
                    </select>

                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="category" id="category">
                        <option selected>{{ __('Relative category') }}</option>
                        <option value="OverAll">OverAll</option>
                        <option value="TeensAll">Teens All</option>
                        <option value="TeensJuniors">Teens+Juniors</option>
                        <option value="MastersAll">Masters All</option>
                        @foreach ($dobne as $dobna)
                        <option value="{{$dobna}}">{{$dobna}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="gender" id="gender">
                        <option selected>{{ __('Gender') }}</option>
                        <option value="M">{{ __('Men') }}</option>
                        <option value="Z">{{ __('Women') }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary gumb m-1"
                            onclick="getRelResults('{{$meet->id}}')">Show</button>
                    </div>
                </div>
                <div class="table-responsive-sm mt-4 p-2">
                <div id="lista2"></div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_after')
<script src="{{asset('js/back/results.js?v=').time()}}" defer></script>
@endsection