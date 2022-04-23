@extends('back_layouts.back-master')
@section('content')
@php 
function ispisiDatum($datum)
{
    return  Carbon\Carbon::parse($datum)->format('d.m.Y');
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
    if ($mjesec < $mjesec0) 
        $starost=$godina0-$godina;
    else 
    {
    $starost=$godina0-$godina-1;
    if ($mjesec==$mjesec0)
    {if ($dan <= $dan0)
        $starost=$godina0-$godina;
    }
     }
     if ($federation == "IPF")
        $starost=$godina0-$godina;
        return $starost;
}
@endphp
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 pb-4">
            <h2 class="text-center p-3 mb-4"><strong>{{$athlete->nomination->meet->naziv}}</strong></h2>
            <h3 class="text-center mt-3 mb-5">{{ __('Weighing') }}</h3>
            <h4 class="text-center p-3 mb-4"><strong>{{$athlete->name}}&nbsp;{{$athlete->surname}}</strong></h4>
            <div class="card card-body shadow">
            <h4><strong>{{ __('Sex') }}:</strong>{{$athlete->spol}}</h4>
           
    <h4><strong>{{ __('Date of birth') }}:</strong>{{ispisiDatum($athlete->nomination->datum)}}</h4>
    <br>
    <h4><strong>{{ __('Age') }}:</strong><i class="text-info">{{ageControll($athlete->nomination->datum,$athlete->nomination->meet->federation->name)}}</i></h4>
    <label for="kategorija"><strong>{{ __('Age category the athlete has applied for') }}:</strong></label>
                       
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
     <p class="text-danger"><i>{{ __('Please check age according to age category the athlete has applied for!') }}</i></p>
   
    <br>
     <h4><strong>{{ __('Weight') }}:</strong><input type="text" class="form-control w-50" name="weight" id="weight"  required></h4>
     <div class="form-group">
                        <label for="kategorija"><strong>{{ __('Weight category the athlete has applied for') }}:</strong></label>
                        <select class="form-select w-75" name="kategorija" id="kategorija">
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
                    </div>
  <p class="text-danger"><i>{{ __('Please check weight according to weight category the athlete has applied for!') }}</i></p>
   
   <br>
    <h4><strong>{{ __('Discipline') }}:</strong>{{$athlete->discipline}}</h4>
    <h3 class="text-center mt-3 mb-5">{{ __('First attempts') }}</h3>
    <div class="form-group">
                    <label for="organizator"><b>{{ __('Squat') }}@include('back_layouts.partials.required-star')</b></label>
                    <input type="text" class="form-control w-50" name="squat" required>
                </div>
                <div class="form-group">
                    <label for="organizator"><b>{{ __('Bench press') }}@include('back_layouts.partials.required-star')</b></label>
                    <input type="text" class="form-control w-50" name="bench" required>
                </div>
                <div class="form-group">
                    <label for="organizator"><b>{{ __('Deadlift') }}@include('back_layouts.partials.required-star')</b></label>
                    <input type="text" class="form-control w-50" name="deadlift" required>
                </div>
  </div>
        </div>
</div>
</div>
@endsection
