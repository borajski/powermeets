@extends('front_layouts.front-master')
@section('content')
@php
function ispisiDatum($datum)
{
return Carbon\Carbon::parse($datum)->format('d.m.Y');
}
@endphp

<section class="vh-100">
	<div class="container-fluid overflow-hidden p-0">
		<div class="row g-0">
			<div class="col-md-6  my-auto text-center text-dark" style="padding:8vw;">
				<div class="mb-3">
					<div editable="img-middle">
						<h1><strong>POWERMEETS</strong>
						<br><small>{{ __('a modern powerlifting software') }}</small></h1>
						<p class="lead">{{ __('Web platform for organizing and managing powerlifting competitions. ') }}</p>
					</div>
				</div>
				<div>
					<a class="btn btn-primary gumb" href="{{route('start')}}#about" role="button">Tell me more</a>
				</div>
			</div>
			<div class="col-md-6 p-4">
				<div class="img-middle">
					<img class="img-fluid " src="{{asset('images/front/powernet-hero.svg')}}" height="3407" alt="powernet">
				</div>
			</div>
         
		</div>
	</div>
</section>
<section class="text-light" style="background-color: #00517D;" id="about">
	<div class="container py-5 text-center">
		<div class="row">
			<div class="col-md-8 offset-md-2 px-4 mt-3 mb-3">
				<div class="mb-4">					
						<h2 class="display-6">PowerMeets<br>{{ __('promotes your competition and powerlifting as sport as well.')}}</h2>					
				</div>
			</div><!-- /col -->
		</div>
	</div>
</section>
<section>
<div class="container pozadina">
	<div class="row">
		<div class="col-md-12 text-center mt-3">
			<div class="lc-block">
				<span class="small mt-4 mb-2 d-block">{{ __('REAL TIME PROCESSING')}}</span>
				<h2 class="display-2 mb-2">{{ __('Full Power')}}</h2>
				<p class="mb-2">{{ __('Take a full control of your competition')}}</p>
			</div>
</div>
	</div>
	<div class="row pt-4">
		<div class="col-lg-3 col-md-6 text-center border">
			<div class="p-4">
				<div>
				<i class="fa-solid fa-rocket fa-3x"></i>
					<h5 class="mt-3 mb-4" editable="inline">
						<strong>{{ __('CREATE')}}</strong>
					</h5>
				</div>
				<div>
					<p>{{ __('Create and customize your competition')}}</p>
					<p>{{ __('Make entry forms')}}</p>
					<p>{{ __('Track entry process')}}</p>
					<p>{{ __('Publish nominations list')}}</p>
				</div>
			</div>		
		</div>
		<div class="col-lg-3 col-md-6 text-center border">
			<div class="p-4">
				<div>
				<i class="fa-solid fa-users-gear fa-3x"></i>
					<h5 class="mt-3 mb-4">
						<strong>{{ __('MANAGE')}}</strong>
					</h5>
				</div>
				<div>
					<p>{{ __('Flight management, publish flights groups')}}</p>
					<p>{{ __('Weight in process, print paperwork')}}</p>
					<p>{{ __('Competition monitoring and results inputs')}}</p>
					<p>{{ __('Online broadcasting')}}</p>
					<p><br></p>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 order-md-4 order-lg-3 text-center border">
			<div class="p-4">
				<div>
				<i class="fa-solid fa-medal fa-3x"></i>
					<h5 class="mt-3 mb-4">
						<strong>{{ __('RESULTS')}}</strong>
					</h5>
				</div>
				<div>
					<p>{{ __('Real time results')}}</p>
					<p>{{ __('Create relative categories')}}</p>
					<p>{{ __('One click full report')}}</p>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 order-md-3 order-lg-4 text-center border">
			<div class="p-4">
				<div>
				<i class="fa-solid fa-desktop fa-3x"></i>
					<h5 class="mt-3 mb-4">
						<strong>{{ __('REPORTS')}}</strong>
					</h5>
				</div>
				<div>
					<p>{{ __('PDF / CSV export')}}</p>
					<p>{{ __('Archive your competition')}}</p>
					<p>{{ __('Cloud hosting')}}</p>
				</div>
			</div>
		</div>
	</div> 
</div>
</section>
<section class="text-light p-3 mt-4 mb-4" style="background-color: #00517D;">
<div class="container text-center py-lg-6 py-4">
	<div class="row justify-content-center">
		<div class="col-xl-7 col-lg-8 col-md-10">
			<div class="mb-4 img-middle">								
					<h2 class="display-4">{{ __('Upcoming Meets')}}</h2>				
			</div>
		</div>
		</div>
</div>
</section>
<section>
@foreach($natjecanja as $natjecanje)
@if ($natjecanje->gensetts->aktivan == 'on')
<div class="container py-5">
 	<div class="row">
		<div class="col-lg-7">		
			<div class="slika-box">
			<div class="blog-kartica-slika" style="background-image:url('{{asset($natjecanje->slika)}}');">
			</div>
			</div>
		</div><!-- /col -->
		<div class="col-lg-5 text-center">
		<p class="mt-3"><strong>{{$natjecanje->federation->name}}</strong></p>
		<h2><strong>{{$natjecanje->naziv}}</strong></h2>
		<p>{{$natjecanje->opis}}</p>
		<p>{{$natjecanje->mjesto}}<br>
	Starting date: {{ispisiDatum($natjecanje->datump)}}</p>
	<div>
					<a class="btn btn-primary gumb float-end" href="meet/{{ $natjecanje->id }}" role="button">Details</a>
				</div>
			
		</div><!-- /col -->
	</div>	
</div>
</section>
@endif
@endforeach
<section  id="contact"  class="text-light mt-4" style="background-color: #00517D;">
<div class="container text-center py-lg-6 py-4">
	<div class="row justify-content-center">
		<div class="col-xl-7 col-lg-8 col-md-10">
			<div class="mb-4 img-middle">								
			<h2 class="p-4 mb-4">
					<span class="podcrta">
					{{ __('CONTACT')}}
					</span>
				</h2>
					<h3 class="text-center p-3" style=" line-height: 1.6;">
					{{ __('PowerMeets is in the development and testing phase.')}}<br>
					{{ __("If you are interested in our solution, feel free to contact us about the platform's capabilities and how you can use this software.")}}	</h3>			
			</div>
		</div>
		</div>
</div>
</section>
<section>
<section style="padding: 20px;background-color: #EAEDF7" >
	<div class="container-fluid mt-4">
		<div class="row p-2">
			<div class="col-sm-6" id="kontakt">		
			</div>
			<div class="col-sm-6 px-4 py-2">
			<form action="/send" method="GET">
                {{ csrf_field() }}
					<div class="form-group">
						<label for="ime">{{ __('Name:')}}</label><input type="text" class="form-control unos" name="ime" required="">
						<br>
					</div>
					<div class="form-group">
						<label for="email">{{ __('Email address:')}}</label><input type="email" class="form-control unos" name="email" required="" onchange="brojIspis()">
						<br>
					</div><br>
					<div class="form-group">
						<label for="poruka">{{ __('Message:')}}</label><textarea class="form-control poruka unos" rows="3" name="poruka" value=""></textarea>
					</div>
			
                  <div class="form-groups">
                     <strong>Recaptcha:</strong>                  
                     {!! NoCaptcha::renderJs() !!}
                     {!! NoCaptcha::display() !!}
                  </div>
          
					<button type="submit" class="btn btn-primary gumb float-end mt-5 mb-3">{{ __('Send')}}</button><br>
				</form>


			</div>
		</div>
	</div>
</section>
@endsection
