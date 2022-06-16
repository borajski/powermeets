<!DOCTYPE html>
<html>
<head>
<style>
.tablica {
  width: 100%;
  border-collapse: collapse;
}
.tablica td 
{
border: 1px solid black;
}
.centar {text-align: center;} 
</style>
<title>Weighing lists</title>
</head>
<body>
@php
function ispisiDatum($datum)
{
return Carbon\Carbon::parse($datum)->format('d.m.Y');
}
$i = 0;
@endphp
<div class="container">
    <div class="row">
        @foreach ($athletes as $athlete)
        <div class="table-responsive">
                <table class="table table-borderless mb-3">
                    <tr>
                        <td colspan="3" class="centar">
                            <h3>{{$athlete->meet->naziv}}<br><small>{{$athlete->discipline}}</small>
                            </h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">{{ __('Name and surname') }}:&nbsp;&nbsp;{{$athlete->name}}&nbsp;&nbsp;{{$athlete->surname}}
                        </td>
                        <td>{{ __('Weight') }}:___________</td>
                    </tr>
                    <tr>
                        <td>{{ __('Birth date') }}:&nbsp;&nbsp;{{ispisiDatum($athlete->nomination->datum)}}</td>
                        <td>{{ __('Weight category') }}: &nbsp;&nbsp;{{$athlete->nomination->kategorijat}}</td>
                        <td>{{ __('Age category') }}:&nbsp;&nbsp;{{$athlete->nomination->kategorijag}}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Rack height - squat:') }}___________</td>
                        <td>{{ __('Rack height - bench press:') }}___________</td>
                        <td>{{ __('Flight') }}: &nbsp;&nbsp;&nbsp;&nbsp;{{$athlete->flight}}</td>
                    </tr>
                </table>
                <p>&nbsp;</p>
                <table class="tablica">
                    <tr>
                        <td style="width: 25%;">{{ __('Lift Number:') }}</td>
                        <td class="centar" style="width: 25%;">1.</td>
                        <td class="centar" style="width: 25%;">2.</td>
                        <td class="centar" style="width: 25%;">3.</td>
                    </tr>
                    <tr>
                        <td>{{ __('Squat') }}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>{{ __('Bench press') }}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>{{ __('Deadlift') }}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>

                <table class="table table-borderless">
                    <tr>
                        <td colspan="2" style="text-align: justify;">
                            <i><small>{{ __('I understand and accept that the organizers, sponsors and all official staff are free from        financial liabilities and claims for damages arising from the reason for loss
or damage if I cause it in a competition, or injury by participating in this competition and I know there is no reason why I could not compete in this competition.

I understand that if I am under the age of 18 this statement is signed by my parent, guardian or coach.') }}</small></i> <br> <br>

                        </td>

                    </tr>

                    <tr>

                        <td class="float-start">{{$athlete->meet->mjesto}},{{ispisiDatum($athlete->meet->datump)}}</td>

                        <td class="float-end"> {{ __('Signature') }}: __________________ </td>
                    </tr>
                
                </table>
                <p>&nbsp;</p>
               
            </div>
            @endforeach
        </div>

    </div>
    </body>
</html>