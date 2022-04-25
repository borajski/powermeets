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
@foreach ($athletes as $athlete)
<div class="table-responsive mb-2">
    <table class="table table-borderless">
    <tr>
    <td> <img src="{{asset($athlete->meet->federation->logo)}}" width="75"></td>
    <td><h3 class="text-center">{{$athlete->meet->naziv}}<br><small>{{$athlete->discipline}}</small></h3></td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>Ime i prezime:&nbsp;&nbsp;{{$athlete->name}}&nbsp;&nbsp;{{$athlete->surname}}</td>
    <td>Klub:&nbsp;&nbsp;{{$athlete->nomination->klub}}</td>
    <td>Tezina:___________</td>
    </tr>
    <tr>
    <td>Datum rodjenja:&nbsp;&nbsp;{{$athlete->nomination->datum}}</td>
    <td>Kategorija: &nbsp;&nbsp;{{$athlete->nomination->kategorijat}}</td>
    <td>Dob:&nbsp;&nbsp;{{$athlete->nomination->kategorijag}}</td>
    </tr>
    <tr>
    <td >Visina stalka za cucanj:___________</td>
    <td >Visina stalka za bench press:___________</td>
    <td>Grupa: &nbsp;&nbsp;&nbsp;&nbsp;{{$athlete->flight}}</td>
    </tr>
    </table>

    <table class="table table-bordered" width="800">
    <tr>
    <td width="200">Dizanje</td>
    <td width="200">1.</td>
    <td width="200">2.</td>
    <td width="200">3.</td>
    </tr>
    <tr>
    <td>Cucanj</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>Bench press</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>Mrtvo dizanje</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>

<table class="table table-borderless">
    <tr>
        <td colspan="2">
<i>Razumijem i prihvacam da su organizatori, sponzori i svo sluzbeno osoblje slobodni od financijskih obveza i potrazivanja za naknadu stete  koja proizlaze iz razloga gubitka ili ostecenja ukoliko ga prouzrocim na natjecanju, ili ozljede sudjelovanjem na ovom natjecanju i znam da nema razloga zasto se ne bih mogao natjecati na ovom natjecanju.

Razumijem da ako sam mladji od 18 godina ovu izjavu potpisuju moj roditelj, staratelj ili trener.</i> <br> <br>

</td>

</tr>

<tr>

<td class="float-start">{{$athlete->meet->mjesto}},{{ispisiDatum($athlete->meet->datump)}}</td>

<td class="float-end"> Potpis: __________________ </td> </tr>

 </table></div>    <br> <br> <br> <br>
 @endforeach
</div>
</div>
@endsection

