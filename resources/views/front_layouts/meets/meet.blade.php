@extends('back_layouts.back-master')
@section('content')
@php
function ispisiDatum($datum)
{
    return  Carbon\Carbon::parse($datum)->format('d.m.Y');
}
@endphp
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="img-wrapper" style="background-image:url('{{asset($meet->slika)}}');">
            </div>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-md-10 offset-md-1 border">
            <h1 class="display-7 text-center "><strong>{{$meet->naziv}}</strong>
                <h1>
                    <h4>{{$meet->opis}}</h4>
                    <h4>Organizator: {{$meet->organizator}}</h4>
                    <h4>Tehnička pravila: {{$meet->federacija}}</h4>
                    <h4>Discipline: {{$meet->discipline}}</h4>
                    <h4>Mjesto: {{$meet->mjesto}}</h4>
                    <h4>Početak: {{ispisiDatum($meet->datump)}}</h4>
                    <h4>Završetak: {{ispisiDatum($meet->datumk)}}</h4>
                    @if ($meet->gensetts)
                    <p>{{$meet->gensetts->objave}}</p>

                    @endif
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-md-10 offset-md-1 border">
            <form action="prijava.php" method="POST">
                <div class="form-group">
                    <label for="ime"><b>Ime:</b></label>
                    <input type="text" class="form-control" name="ime" placeholder="Vaše ime" required />
                </div>
                <div class="form-group">
                    <label for="prezime"><b>Prezime:</b></label>
                    <input type="text" class="form-control" name="prezime" placeholder="Vaše prezime" required />
                </div>
                <div class="form-group">
                    <label for="email"><b>Email:</b></label>
                    <input type="email" class="form-control" name="email" placeholder="Unesite vaš email" required />
                </div>
                <div class="form-group">
                    <label for="datum-r"><b>Datum rođenja: </b></label>
                    <input class="form-control" type="date" name="datum-r"/>
                </div>
                <div class="form-group">
                        <label for="spol"><b>Spol:</b></label>
                        <select class="form-select" id="spol" name="spol"
                            onchange="weightCat(this.value,'{{$federacija->name}}')" required>
                            <option selected></option>
                            <option value="M">Muški</option>
                            <option value="Z">Ženski</option>
                        </select>
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
                    <div class="form-group">
                        <label for="dobna_kategorija">Dobna kategorija:</label>
                        <select class="form-select" name="dobna">
                            <option selected></option>
                            @php
                            $dobne = explode(",",$federacija->age_categories);

                            foreach ($dobne as $dob)
                            {
                            echo '<option value="'.$dob.'">'.$dob.'</option>';
                            }
                            @endphp
                        </select>
                    </div>         
                    <div class="form-group">
                        <label for="kategorija">Težinska kategorija:</label>
                        <select class="form-select" name="kategorija" id="kategorija">

                        </select>
                    </div>
                    <div class="text-end mt-3 mb-3">
                        <button type="submit" class="btn btn-primary">
                            PRIJAVA
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js_after')
<script>
function weightCat(spol, fed) {
    var wcat = spol + ',' + fed;
    document.getElementById("kategorija").innerHTML = "";
    const xhttp = new XMLHttpRequest();
    var url = "weightCat/" + wcat;
    xhttp.onload = function() {
        document.getElementById("kategorija").innerHTML = this.responseText;
    }
    xhttp.open("GET", url, true);
    xhttp.send();
}
</script>
@endsection