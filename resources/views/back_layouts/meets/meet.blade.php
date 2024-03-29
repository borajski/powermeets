@extends('back_layouts.back-master')
@section('css_before')
<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css" integrity="sha384-07UbSXbd8HpaOfxZsiO6Y8H1HTX6v0J96b5qP6PKSpYEuSZSYD4GFFHlLRjvjVrL" crossorigin="anonymous">
@endsection
@section('js_before')
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
@endsection
@section('content')
@php
function ispisiDatum($datum)
{
return Carbon\Carbon::parse($datum)->format('d.m.Y');
}
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
            <div class="col-md-10 offset-md-1 border bg-light">

                <p class="pt-3 pb-3 m-3">
                    <span class="float-start"><strong>OPĆE POSTAVKE</strong></span>
                    <button class="btn btn-primary btn-sm float-end" type="button" onclick="editMeet()">Uredi</button>
                </p>
                <h1 class="text-center m-4"><strong>{{$meet->naziv}}</strong></h1>
                <h2 class="text-center m-4">{{$meet->opis}}</h2>
                <h3 class="m-2"><b>Organizator:</b> <small>{{$meet->organizator}}</small></h3>
                <h3 class="m-2"><b>Tehnička pravila:</b> <small> {{$meet->federation->name}}</small></h3>
                <h3 class="m-2"><b>Mjesto:</b> <small> {{$meet->mjesto}}</small></h3>
                <h3 class="m-2"><b>Početak:</b> <small> {{ispisiDatum($meet->datump)}}</small></h3>
                <h3 class="m-2"><b>Završetak:</b> <small> {{ispisiDatum($meet->datumk)}}</small></h3>


            </div>
        </div>
    </div>

    <div id="uredi" style="display:none;">
        <div class="row">
            <div class="col-md-10 offset-md-1 bg-light">
                <h2 class="mb-5">Edit meet</h2>
                <form enctype="multipart/form-data" action="{{ route('meets.update',$meet->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{method_field('patch') }}
                    <div class="form-group align-center">
                        <label for="slika">Odaberi novu cover fotografiju:</label>
                        <br>
                        <img class="align-center img-responsive img-thumbnail" id="output" src="{{asset($meet->slika)}}"
                            width="100%" alt="meet-cover">
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
                        <input type="text" class="form-control" name="organizator" value="{{$meet->organizator}}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="opis"><b>O natjecanju:</b></label>
                        <textarea class="form-control" name="opis" rows="5">{{$meet->opis}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="federacija"><b>Federacija: {{$meet->federation->name}}
                            </b></label>
                        <input type="hidden" name="federacija" value="{{$meet->federation_id}}">
                        <select name="federacija" class="form-control" onchange="getFed(this.value)" required>
                            <option value="{{$meet->federation_id}}" selected>{{$meet->federation->name}}</option>
                            @foreach ($federacije as $federacija)
                            <option value="{{$federacija->id}}">{{$federacija->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mjesto"><b>Mjesto: @include('back_layouts.partials.required-star')</b></label>
                        <input type="text" class="form-control" name="mjesto" value="{{$meet->mjesto}}" required>
                    </div>

                    <div class="form-group mt-4 mb-4">
                        <div id="discipline">
                            <label for="discipline"><b>DISCIPLINE:</b></label>
                            <br>
                            @php
                            $discipline = explode(",",$meet->federation->disciplines);
                            $meet_discipline = explode(',',$meet->discipline);
                            $divizije = explode(",",$federacija->divisions);
                            foreach ($divizije as $divizija)
                            {
                            $predznak = substr($divizija,0,2).'-';
                            echo '<div class="form-group mt-4 mb-4">
                                <label for="'.$divizija.'"><b>'.$divizija.':</b></label><br>';

                                foreach ($discipline as $disciplina) {
                                   
                                $disciplina_m = $predznak.$disciplina;
                            
            
                                // varijabla disciplina_m oznacava dispiplinu na natjecanju s obzirom na diviziju
                               
                                if (in_array($disciplina_m, $meet_discipline)) {
                            
                                echo '<div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="discipline[]"
                                        value="'.$predznak.$disciplina.'" checked>
                                    <label class="form-check-label"
                                        for="'.$predznak.$disciplina.'">'.ucfirst($disciplina).'</label>
                                </div>';
                                }
                                 else {
                                echo '<div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="discipline[]"
                                        value="'.$predznak.$disciplina.'">
                                    <label class="form-check-label"
                                        for="'.$predznak.$disciplina.'">'.ucfirst($disciplina).'</label>
                                </div>';
                                }
                            
                                }
                                echo '
                            </div>';
                            }


                            @endphp
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
        <div class="col-md-10 offset-md-1 border bg-light">
            <form class="m-3" enctype="multipart/form-data" action="{{ route('gensetts.update', $meet->gensetts->id) }}"
                method="POST" id="emsett">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <div class="form-group">
                    <label for="em_poruke">
                        <h4 class="m-2">Sadržaj email poruke</h4>
                    </label>
                    <div id="email-container"></div>
                    <input type="hidden" name="em_poruka" id="emporuka" />
                    <input class="form-check-input" type="hidden" name="meet_id" value="{{$meet->id}}">
                    <input class="form-check-input" type="hidden" name="aktivan" value="{{$meet->gensetts->aktivan}}">
                    <input class="form-check-input" type="hidden" name="prijavnica"
                        value="{{$meet->gensetts->prijavnica}}">
                    <input class="form-check-input" type="hidden" name="nominacije"
                        value="{{$meet->gensetts->nominacije}}">
                    <input class="form-check-input" type="hidden" name="natjecanje"
                        value="{{$meet->gensetts->natjecanje}}">
                    <input class="form-check-input" type="hidden" name="rezultati"
                        value="{{$meet->gensetts->rezultati}}">
                    <input type="hidden" name="objave" value="{{$meet->gensetts->objave}}">
                </div>
                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">Spremi</button>
                </div>
            </form>
        </div>
    </div>


    <div class="row pt-4">
        <div class="col-md-10 offset-md-1 border bg-light">
            <h4 class="m-3">Postavke javnosti</h4>
            <form class="m-3" enctype="multipart/form-data" action="{{ route('gensetts.update', $meet->gensetts->id) }}"
                method="POST" id="gensetts">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="aktivan" {{$aktivan}}>
                    <input class="form-check-input" type="hidden" name="meet_id" value="{{$meet->id}}">
                    <input type="hidden" name="em_poruka" value="{{$meet->gensetts->em_poruka}}">
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
                <div class="form-group">
                    <label for="objave">
                        <h4 class="m-2">Objave:</h4>
                    </label>
                    <div id="editor-container"></div>                 
                    <input type="hidden" name="objave" id="objava"/>
                    
                </div>               
                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">Spremi</button>
                </div>
            </form>
        </div>
    </div>
@endsection
        @section('js_after')
        <script src="{{asset('js/back/meet.js')}}" defer></script>
        <script>
        /*quill rich text editor za objave*/
        var quill = new Quill('#editor-container', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'Napiši prvu objavu...',
            theme: 'snow' // or 'bubble'
        });
        /*quill rich text editor za email poruke*/
       var quill_e = new Quill('#email-container', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'automatska email poruka natjecatelju nakon uspješne prijave',
            theme: 'snow' // or 'bubble'
        }); 
        /*skripta za preuzimanje sadržaja iz quilla za objave*/
        var form1 = document.getElementById("gensetts");
        form1.onsubmit = function() {
           // var name = document.querySelector('input[name=objave]');
            var name = document.getElementById("objava");
            name.value = JSON.stringify(quill.getContents());
            return true; // submit form
        }
        quill.setContents({!!$meet->gensetts->objave!!});
        /*skripta za preuzimanje sadržaja iz quilla za em_poruke*/
        var form2 = document.getElementById("emsett");
        form2.onsubmit = function() {
           // var name = document.querySelector('input[name=em_poruka]');
           var name = document.getElementById("emporuka");
            name.value = JSON.stringify(quill_e.getContents());
            return true; // submit form
        }
        quill_e.setContents({!!$meet->gensetts->em_poruka!!});
        </script>
        @endsection