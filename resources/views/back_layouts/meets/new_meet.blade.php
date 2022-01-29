@extends('back_layouts.back-master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="mb-5">Create new meet</h2>
<form enctype="multipart/form-data" action="{{route('meets.store')}}" method="POST">
    {{ csrf_field() }}
    <div class="form-group align-center">
                            <label for="slika">Odaberi cover fotografiju:</label>
                            <br>
                            <img class="align-center img-responsive img-thumbnail" id="output" 
                                src="{{asset('images/meets/default-cover.png')}}"  width="100%" alt="meet-cover">
                                <br>
                            <input type="file" class="form-control-file pt-2" name="slika"
                            accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                        </div>
    <div class="form-group">
        <label for="naziv"><b>Naziv natjecanja: @include('back_layouts.partials.required-star')</b></label>
        <input type="text" class="form-control" name="naziv" required>
    </div>
    <div class="form-group">
        <label for="organizator"><b>Organizator natjecanja: @include('back_layouts.partials.required-star')</b></label>
        <input type="text" class="form-control" name="organizator" required>
    </div>
    <div class="form-group">
        <label for="opis"><b>O natjecanju:</b></label>
        <textarea class="form-control" name="opis" rows="5"></textarea>
    </div>
    <div class="form-group">
        <label for="federacija"><b>Federacija: @include('back_layouts.partials.required-star')</b></label>
        <select name="federacija" class="form-control" required>
            <option selected></option>
            <option value="IPF">IPF</option>
            <option value="GPC">GPC</option>
            <option value="WRPF">WRPF</option>
            <option value="WUAP">WUAP</option>
            <option value="WPC">WPC</option>
        </select>
    </div> 
    <div class="form-group">
        <label for="mjesto"><b>Mjesto: @include('back_layouts.partials.required-star')</b></label>
        <input type="text" class="form-control" name="mjesto" required>
    </div>
    <div class="form-group mt-4 mb-4">
        <label for="raw-discipline"><b>Discipline RAW (Classic):
               </b></label>
        <br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox"  name="discipline[]" value="powerlifting">
            <label class="form-check-label" for="powerlifting">Powerlifting</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="discipline[]" value="squat">
            <label class="form-check-label" for="squat">Squat</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="discipline[]" value="benchpress">
            <label class="form-check-label" for="benchpress">Bench press</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="discipline[]" value="deadlift">
            <label class="form-check-label" for="deadlift">Deadlift</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="discipline[]" value="pushpull">
            <label class="form-check-label" for="pushpull">Push&pull</label>
        </div>
    </div>
    <div class="form-group mt-4 mb-4"">
        <label for="raw-discipline"><b>Discipline Equipment:
               </b></label>
        <br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox"  name="discipline[]" value="e-powerlifting">
            <label class="form-check-label" for="powerlifting">Powerlifting</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="discipline[]" value="e-squat">
            <label class="form-check-label" for="squat">Squat</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="discipline[]" value="e-benchpress">
            <label class="form-check-label" for="benchpress">Bench press</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="discipline[]" value="e-deadlift">
            <label class="form-check-label" for="deadlift">Deadlift</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="discipline[]" value="e-pushpull">
            <label class="form-check-label" for="pushpull">Push&pull</label>
        </div>
    </div>
    <div class="form-group">
        <label for="datum-p"><b>Datum početka: @include('back_layouts.partials.required-star')</b></label>
        <input class="form-control" type="date" name="datump" />
    </div>
    <div class="form-group">
        <label for="datum-p"><b>Datum završetka: @include('back_layouts.partials.required-star')</b></label>
        <input class="form-control" type="date" name="datumk" />
    </div>
     <div class="mt-4 text-end">
    <button type="submit" class="btn btn-primary">Create</button>
        </div>
</form>
        </div>
        </div>
        </div>
@endsection