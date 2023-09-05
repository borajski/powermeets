@extends('back_layouts.back-master')
@section('content')
@php
function ispisiDatum($datum)
{
return Carbon\Carbon::parse($datum)->format('d.m.Y');
}
function ageControll($datum,$federation)
{
$unos = Carbon\Carbon::parse($datum)->format('d.m.Y');
$danas = Carbon\Carbon::Now()->format('d.m.Y');
$danas=explode (".",$danas);
$dobni_podaci=explode (".",$unos);
$dan0=$danas[0];
$mjesec0=$danas[1];
$godina0=$danas[2];

$dan=$dobni_podaci[0];
$mjesec=$dobni_podaci[1];
$godina=$dobni_podaci[2];
$danm=str_split($dan);
if ($danm[0]="0")
$dan=$danm[1];
$mjesecm=str_split($mjesec);
if ($mjesecm[0]="0")
$mjesec=$mjesecm[1];
if ($mjesec < $mjesec0) $starost=$godina0-$godina; else { $starost=$godina0-$godina-1; if ($mjesec==$mjesec0) {if ($dan
    <=$dan0) $starost=$godina0-$godina; } } if ($federation=="IPF" ) $starost=$godina0-$godina; return $starost; }
    @endphp 
    <div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 pb-4">
            <h2 class="text-center p-3 mb-4"><strong>{{$athlete->nomination->meet->naziv}}</strong></h2>
            <h3 class="text-center mt-3 mb-5">{{ __('Weighing') }}</h3>
            <h3 class="text-center p-3 mb-4"><strong>{{$athlete->name}}&nbsp;{{$athlete->surname}}</strong></h3>
            @if ($athlete->results)
            <h4 class="text-center text-danger p-3 mb-4"><strong>{{ __('The athlete has done a weigh-in') }}</strong></h4>
            @else
            <div class="card card-body shadow">
                <h4><strong>{{ __('Sex') }}: </strong>{{$athlete->spol}}</h4>

                <h4><strong>{{ __('Date of birth') }}:</strong>
                <input type="text" class="form-control w-50" name="datum-r" id="datum-r" value="{{ispisiDatum($athlete->nomination->datum)}}"
                 onchange="kontrolaDatuma('{{$athlete->nomination->meet->federation->name}}')"; required>
                </h4>
                <br>

                <h4><strong>{{ __('Age') }}:</strong>
                <i class="text-info" id="godine">{{ageControll($athlete->nomination->datum,$athlete->nomination->meet->federation->name)}}</i>
                </h4>
                <form enctype="multipart/form-data" action="{{route('results.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label
                            for="kategorija"><strong>{{ __('Age category the athlete has applied for') }}:</strong></label>
                        <select class="form-select w-75" name="dobna">
                            <option value="{{$athlete->kategorijag}}" selected>{{$athlete->kategorijag}}</option>
                            @php
                            $dobne = explode(",",$athlete->nomination->meet->federation->age_categories);
                            foreach ($dobne as $dob)
                            {
                            echo '<option value="'.$dob.'">'.$dob.'</option>';
                            }
                            @endphp
                        </select>
                    </div>
                    <p class="text-danger">
                        <i>{{ __('Please check age according to age category the athlete has applied for!') }}</i></p>

                    <br>
                    <h4><strong>{{ __('Weight') }}:</strong>
                    <input type="text" class="form-control w-50" name="weight"
                            required></h4>
                    <div class="form-group">
                        <label
                            for="kategorija"><strong>{{ __('Weight category the athlete has applied for') }}:</strong></label>
                        <select class="form-select w-75" name="kategorijat">
                            <option value="{{$athlete->kategorijat}}" selected>{{$athlete->kategorijat}}</option>
                            @php
                            if ($athlete->spol == "M")
                            $tezinske = explode(",",$athlete->nomination->meet->federation->wm_categories);
                            else
                            $tezinske = explode(",",$athlete->nomination->meet->federation->wf_categories);
                            foreach ($tezinske as $tezina)
                            {
                            echo '<option value="'.$tezina.'">'.$tezina.'</option>';
                            }
                            @endphp
                        </select>
                        <input type="hidden" class="form-control" name="athlete_id" value="{{$athlete->id}}">
                        <input type="hidden" class="form-control" name="starost" id="starost" value="{{ageControll($athlete->nomination->datum,$athlete->nomination->meet->federation->name)}}">
                 
                    </div>
                    <p class="text-danger">
                        <i>{{ __('Please check weight according to weight category the athlete has applied for!') }}</i>
                    </p>

                    <br>
                    <h4><strong>{{ __('Discipline') }}:</strong>{{$athlete->discipline}}</h4>
                    <h3 class="text-center mt-3 mb-5">{{ __('First attempts') }}</h3>
                    <div class="form-group">
                        <label
                            for="squat"><b>{{ __('Squat') }}@include('back_layouts.partials.required-star')</b></label>
                        <input type="text" class="form-control w-50" name="squat" required>
                    </div>
                    <div class="form-group">
                        <label
                            for="bench"><b>{{ __('Bench press') }}@include('back_layouts.partials.required-star')</b></label>
                        <input type="text" class="form-control w-50" name="bench" required>
                    </div>
                    <div class="form-group">
                        <label
                            for="deadlift"><b>{{ __('Deadlift') }}@include('back_layouts.partials.required-star')</b></label>
                        <input type="text" class="form-control w-50" name="deadlift"  required>
                    </div>
                    <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </form>
            </div>
            @endif
        </div>
    </div>
    </div>
    @endsection
    @section('js_after')
    <script>
    function kontrolaDatuma(federation)
     {
        var datum = document.getElementById("datum-r").value;
        const dateParts = datum.split('.');
        const currentDate = new Date();

  // Extract day, month, and year from the array
  const dan = parseInt(dateParts[0], 10);
  const mjesec = parseInt(dateParts[1], 10);
  const godina = parseInt(dateParts[2], 10);  

const dan0 = String(currentDate.getDate()).padStart(2, '0'); // Get day and pad with leading zero if needed
const mjesec0 = String(currentDate.getMonth() + 1).padStart(2, '0'); // Get month (adding 1 since months are zero-based) and pad with leading zero if needed
const godina0 = String(currentDate.getFullYear());

  if (mjesec < mjesec0) {
    var starost = godina0 - godina;
  } else {
    var starost = godina0 - godina - 1;
    if (mjesec === mjesec0) {
      if (dan <= dan0) {
        starost = godina0 - godina;
      }
    }
  }
  
  if (federation === "IPF") {
    starost = godina0 - godina;
  }
 document.getElementById("godine").innerHTML = starost;
 document.getElementById("starost").value = starost;
}
        </script>
    @endsection