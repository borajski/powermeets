@extends('back_layouts.back-master')
@section('content')
@php 
if ($meet->gensetts)
{
    if ($meet->gensetts->aktivan == 'on')
      $aktivan = 'checked';
      else
        $aktivan = '';
    if ($meet->gensetts->prijavnica == 'on')
      $prijavnica = 'checked';
      else
        $prijavnica = '';
    if ($meet->gensetts->nominacije == 'on')
      $nominacije = 'checked';
      else
        $nominacije = '';
    if ($meet->gensetts->natjecanje == 'on')
      $natjecanje = 'checked';
      else
        $natjecanje = '';
    if ($meet->gensetts->rezultati == 'on')
      $rezultati = 'checked';
      else
        $rezultati = '';
}
else
{
    $aktivan = '';
    $prijavnica = '';
    $nominacije = '';
    $nominacije = '';
    $natjecanje = '';
    $rezultati = '';

}
@endphp

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
                <h2 class="mb-5">Edit meet</h2>
                <form enctype="multipart/form-data" action="{{ route('meets.update',$meet->id) }}" method="POST">
                {{ csrf_field() }}
                {{method_field('patch') }}
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
                            @foreach ($federacije as $federacija)
                            <option value="{{$federacija->name}}">{{$federacija->name}}</option>
                   @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mjesto"><b>Mjesto: @include('back_layouts.partials.required-star')</b></label>
                        <input type="text" class="form-control" name="mjesto" value="{{$meet->mjesto}}" required>
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <label for="discipline"><b>DISCIPLINE:</b></label>
                        <br>
                    @php
                    $discipline = explode(",",$federacija->disciplines);
                    $meet_discipline = explode(',',$meet->discipline);
                    $divizije = explode(",",$federacija->divisions);
                    
                    foreach ($divizije as $divizija) 
                    {
                    $predznak = substr($divizija,0,2).'-';
                    echo '<div class="form-group mt-4 mb-4">
                            <label for="'.$divizija.'"><b>'.$divizija.':
                            </b></label><br>';
                    
                        foreach ($discipline as $disciplina) {
                            $disciplina_m = $predznak.$disciplina;
                            // varijabla disciplina_m oznacava dispiplinu na natjecanju s obzirom na diviziju
                            if (in_array($disciplina_m, $meet_discipline)) {
                                echo '<div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="discipline[]" value="'.$predznak.$disciplina.'" checked>
                <label class="form-check-label" for="'.$predznak.$disciplina.'">'.ucfirst($disciplina).'</label>
            </div>';
                            } else {
                                echo '<div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="discipline[]" value="'.$predznak.$disciplina.'">
                <label class="form-check-label" for="'.$predznak.$disciplina.'">'.ucfirst($disciplina).'</label>
            </div>';
                            }
                        }
                        echo '</div>';
                    }

                    
                    @endphp                       
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
            <h4>Postavke javnosti</h4>
            @if ($meet->gensetts)
    <form enctype="multipart/form-data" action="{{ route('gensetts.update', $meet->gensetts->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        @else
        <form enctype="multipart/form-data" action="{{route('gensetts.store')}}" method="POST">
            {{ csrf_field() }}
            @endif
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="aktivan" {{$aktivan}}>
                <input class="form-check-input" type="hidden" name="meet_id" value="{{$meet->id}}">
                <label class="form-check-label" for="aktivan">Objavi natjecanje javno</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="prijavnica" {{$prijavnica}}>
                <label class="form-check-label" for="prijavnica">Objavi prijavnicu</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="nominacije" {{$nominacije}}>
                <label class="form-check-label" for="nominacije">Objavi listu prijavljenih</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="natjecanje" {{$natjecanje}}>
                <label class="form-check-label" for="natjecanje">Javno praćenje natjecanja</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="rezultati" {{$rezultati}}>
                <label class="form-check-label" for="rezultati">Objavi rezultate</label>
            </div>
            @if ($aktivan == 'checked')
            <div class="form-group">
                    <label for="objave"><b>Objave:</b></label>
                    <textarea class="form-control" name="objave" rows="4">{{$meet->gensetts->objave}}</textarea>
                </div>
            @endif
            <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary">Spremi</button>
                    </div>
            </form>
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