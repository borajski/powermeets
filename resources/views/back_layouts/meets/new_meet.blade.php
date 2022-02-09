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
                        src="{{asset('images/meets/default-cover.png')}}" width="100%" alt="meet-cover">
                    <br>
                    <input type="file" class="form-control-file pt-2" name="slika" accept="image/*"
                        onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                </div>
                <div class="form-group">
                    <label for="naziv"><b>Naziv natjecanja: @include('back_layouts.partials.required-star')</b></label>
                    <input type="text" class="form-control" name="naziv" required>
                </div>
                <div class="form-group">
                    <label for="mjesto"><b>Mjesto: @include('back_layouts.partials.required-star')</b></label>
                    <input type="text" class="form-control" name="mjesto" required>
                </div>
                <div class="form-group">
                    <label for="organizator"><b>Organizator natjecanja:
                            @include('back_layouts.partials.required-star')</b></label>
                    <input type="text" class="form-control" name="organizator" required>
                </div>
                <div class="form-group">
                    <label for="opis"><b>O natjecanju:</b></label>
                    <textarea class="form-control" name="opis" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="federacija"><b>Federacija: @include('back_layouts.partials.required-star')</b></label>
                    <select name="federacija"  class="form-control" onchange="getFed(this.value)" required>
                        <option selected></option>
                    @foreach ($federacije as $federacija)
                        <option value="{{$federacija->id}}">{{$federacija->name}}</option>
                    @endforeach
                      </select>
                </div>
                <div id="discipline"></div>          
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
@section('js_after')
<script>
function getFed (fed) {   
    document.getElementById("discipline").innerHTML = ""; 
    const xhttp = new XMLHttpRequest();
    var url="fedRules/" + fed;
    xhttp.onload = function() {
    document.getElementById("discipline").innerHTML = this.responseText;
    }  
    xhttp.open("GET", url, true);
    xhttp.send();   
}
</script>
@endsection