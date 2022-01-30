@extends('back_layouts.back-master')
@section('content')
<div class="container">
    <div id="postavke">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="img-wrapper" style="background-image:url('{{asset($meet->slika)}}');">
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md-10 offset-md-1 border">

                <p class="pt-3">
                    <span class="float-start" strong>OPĆE POSTAVKE</strong></span>
                    <button class="btn btn-primary btn-sm float-end" type="button" onclick="editMeet()">Uredi</button>
                </p>

                <h1 class="display-7 text-center "><strong>{{$meet->naziv}}</strong>
                    <h1>
                        <h4>{{$meet->opis}}</h4>
                        <h4>Organizator: {{$meet->organizator}}</h4>
                        <h4>Tehnička pravila: {{$meet->federacija}}</h4>
                        <h4>Discipline: {{$meet->discipline}}</h4>
                        <h4>Mjesto: {{$meet->mjesto}}</h4>
                        <h4>Početak: {{$meet->datump}}</h4>
                        <h4>Završetak: {{$meet->datumk}}</h4>

            </div>
        </div>
    </div>
           
 <div id="uredi" style="display:none;">
 <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="mb-5">Create new meet</h2>
                <form enctype="multipart/form-data" action="{{route('meets.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group align-center">
                        <label for="slika">Odaberi novu cover fotografiju:</label>
                        <br>
                        <img class="align-center img-responsive img-thumbnail" id="output"
                            src="{{asset($meet->slika)}}" width="100%" alt="meet-cover">
                        <br>
                        <input type="file" class="form-control-file pt-2" name="slika" accept="image/*"
                            onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="form-group">
                        <label for="naziv"><b>Naziv natjecanja:
                                @include('back_layouts.partials.required-star')</b></label>
                        <input type="text" class="form-control" name="naziv" value="{{$meet->naziv}}" required>
                    </div>
                    <div class="form-group">
                        <label for="organizator"><b>Organizator natjecanja:
                                @include('back_layouts.partials.required-star')</b></label>
                        <input type="text" class="form-control" name="organizator" value="{{$meet->organizator}}" required>
                    </div>
                    <div class="form-group">
                        <label for="opis"><b>O natjecanju:</b></label>
                        <textarea class="form-control" name="opis" rows="5">{{$meet->opis}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="federacija"><b>Federacija:
                                @include('back_layouts.partials.required-star')</b></label>
                        <select name="federacija" class="form-control" required>
                            <option  value="{{$meet->federacija}}" selected>{{$meet->federacija}}</option>
                            <option value="IPF">IPF</option>
                            <option value="GPC">GPC</option>
                            <option value="WRPF">WRPF</option>
                            <option value="WUAP">WUAP</option>
                            <option value="WPC">WPC</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mjesto"><b>Mjesto: @include('back_layouts.partials.required-star')</b></label>
                        <input type="text" class="form-control" name="mjesto" value="{{$meet->mjesto}}" required>
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <label for="raw-discipline"><b>Discipline RAW (Classic):
                            </b></label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="discipline[]" value="powerlifting">
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
                    <div class="form-group mt-4 mb-4">
                        <label for=" raw-discipline"><b>Discipline Equipment:
                            </b></label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="discipline[]" value="e-powerlifting">
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
                        <label for="datum-p"><b>Datum početka:
                                @include('back_layouts.partials.required-star')</b></label>
                        <input class="form-control" type="date" name="datump" value="{{$meet->datump}}" />
                    </div>
                    <div class="form-group">
                        <label for="datum-p"><b>Datum završetka:
                                @include('back_layouts.partials.required-star')</b></label>
                        <input class="form-control" type="date" name="datumk" value="{{$meet->datumk}}" />
                    </div>
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
</div>
</div>
    <div class="row pt-4">
        <div class="col-md-10 offset-md-1 border">
            <p>Postavke javnosti</p>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="aktivan">
                <label class="form-check-label" for="aktivan">Objavi natjecanje javno</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="prijavnica">
                <label class="form-check-label" for="prijavnica">Objavi prijavnicu</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="nominacije">
                <label class="form-check-label" for="nominacije">Objavi listu prijavljenih</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="natjecanje">
                <label class="form-check-label" for="natjecanje">Javno praćenje natjecanja</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="rezultati">
                <label class="form-check-label" for="rezultati">Objavi rezultate</label>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_after')
<script>
function editMeet() {
    document.getElementById('postavke').style.display = "none";
    document.getElementById('uredi').style.display = "block";

}
</script>
@endsection