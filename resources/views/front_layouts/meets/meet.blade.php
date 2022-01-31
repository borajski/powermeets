@extends('back_layouts.back-master')
@section('content')
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
                        <h4>Početak: {{$meet->datump}}</h4>
                        <h4>Završetak: {{$meet->datumk}}</h4>
                        @if ($meet->gensetts)
                        <p>{{$meet->gensetts->objave}}</p>
                        @endif
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md-10 offset-md-1 border">


    
     
        <form action="prijava.php" method="POST" style="width: 75%; padding-bottom: 2%;">
          <div class="form-group">
            <label for="ime">Ime:</label>
            <input
              type="text"
              class="form-control"
              name="ime"
              placeholder="VaĹˇe ime"
              required
            />
          </div>
          <div class="form-group">
            <label for="prezime">Prezime:</label>
            <input
              type="text"
              class="form-control"
              name="prezime"
              placeholder="VaĹˇe prezime"
              required
            />
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input
              type="email"
              class="form-control"
              name="email"
              placeholder="Unesite vaĹˇ email"
              required
            />
          </div>
          <div class="form-group">
            <label for="datum">Datum roÄ‘enja:</label>
            <input
              type="text"
              class="form-control date"
              id="birth-date-picker"
              name="datum"
              placeholder="VaĹˇ datum roÄ‘enja"
              required
            />
          </div>
          <div class="form-group">
            <label for="spol">Spol:</label>
            <select class="form-select" id="spol" name="spol" style="width: 100%" required>
              <option selected></option>
              <option value="M">Muški</option>
              <option value="Z">Ženski</option>
            </select>
          </div>
          <div class="form-group" id="kategorija">
            <label for="kategorija">Kategorija:</label>
            <select class="form-select" name="kategorija" style="width: 100%">
              <option selected></option>
              <option value="-100">-100</option>
              <option value="100">+100</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary float-right">
            PRIJAVA
          </button>
        </form>
        </div>
        </div>
</div>
  

    <script>
      $("#spol").on("change", function () {
        if (this.value == "M") {
          $("#kategorija").show();
        } else {
          $("#kategorija").hide();
        }
      });

    </script>
@endsection