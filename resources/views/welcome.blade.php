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
						<br><small>a modern powerlifting software</small></h1>
						<p class="lead">Web platform for organizing and managing powerlifting competitions. </p>
					</div>
				</div>
				<div>
					<a class="btn btn-primary gumb" href="#" role="button">Tell me more</a>
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
			<div class="col-md-8 offset-md-2 px-4">
				<div class="mb-4">					
						<h2 class="display-6">PowerMeets<br>promotes your competition and powerlifting as sport as well.</h2>					
				</div>
			</div><!-- /col -->
		</div>
	</div>
</section>
<section>
<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="lc-block">
				<span editable="inline" class="small mt-4 d-block">REAL TIME PROCESSING</span>
				<h2 editable="inline" class="display-2 mb-0">Full Power&nbsp;</h2>
				<p editable="inline" class="">Take a full control of your competition</p>
			</div>
</div>
	</div>
	<div class="row pt-4">
		<div class="col-lg-3 col-md-6 text-center border">
			<div class="p-4">
				<div>
				<i class="fa-solid fa-rocket fa-3x"></i>
					<h5 class="mt-3 mb-4" editable="inline">
						<strong>CREATE</strong>
					</h5>
				</div>
				<div>
					<p>Create and customize your competition</p>
					<p>Make entry forms</p>
					<p>Track entry process</p>
					<p>Publish nominations list</p>
				</div>
			</div>		
		</div>
		<div class="col-lg-3 col-md-6 text-center border">
			<div class="p-4">
				<div>
				<i class="fa-solid fa-users-gear fa-3x"></i>
					<h5 class="mt-3 mb-4">
						<strong>MANAGE</strong>
					</h5>
				</div>
				<div>
					<p>Flight management, publish flights groups</p>
					<p>Weight in process, print paperwork</p>
					<p>Competition monitoring and results inputs</p>
					<p>Online broadcasting</p>
					<p><br></p>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 order-md-4 order-lg-3 text-center border">
			<div class="p-4">
				<div>
				<i class="fa-solid fa-medal fa-3x"></i>
					<h5 class="mt-3 mb-4">
						<strong>RESULTS</strong>
					</h5>
				</div>
				<div>
					<p>Real time results</p>
					<p>Create relative categories</p>
					<p>One click full report</p>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 order-md-3 order-lg-4 text-center border">
			<div class="p-4">
				<div>
				<i class="fa-solid fa-desktop fa-3x"></i>
					<h5 class="mt-3 mb-4">
						<strong>REPORTS</strong>
					</h5>
				</div>
				<div>
					<p>PDF / CSV export</p>
					<p>Archive your competition</p>
					<p>Cloud hosting</p>
				</div>
			</div>
		</div>
	</div> 
</div>
</section>
<section class="text-light mt-4" style="background-color: #00517D;">
<div class="container text-center py-lg-6 py-4">
	<div class="row justify-content-center">
		<div class="col-xl-7 col-lg-8 col-md-10">
			<div class="mb-4 img-middle">								
					<h2 class="display-4">Upcoming Meets</h2>				
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
<section id="contact" style="padding: 20px;background-color: #EAEDF7">
	<div class="container-fluid mt-2">
		<div class="row px-2">
			<div class="col-sm-6" id="kontakt">
				<h2 class="naslov p-3">
					<span class="podcrta">
						CONTACT
					</span>
				</h2>
				<div class="px-5">
					<p class="text-center lead">
					PowerMeets is in the development and testing phase. If you are interested in our solution, feel free to contact us about the platform's capabilities and how you can use this software.	</p>

				</div>
			</div>
			<div class="col-sm-6 px-4 py-2">
				<form id="inova-cf" action="/" method="post"><br>
					<div class="form-group">
						<label for="ime">Ime/Naziv:</label><input type="text" class="form-control unos" name="cf-name" value="" id="inlineFormInput" placeholder="Unesite ime ili naziv" required="">
						<br>
					</div>
					<div class="form-group">
						<label for="email">Email adresa:</label><input type="email" class="form-control unos" name="cf-email" value="" id="inlineFormInput" placeholder="Unesite valjanu email adresu" required="">
						<br>
					</div><br>
					<div class="form-group">
						<label for="poruka">Poruka:</label><textarea class="form-control poruka unos" rows="3" name="cf-message" value="" id="inlineFormInput">    </textarea>
					</div><button type="submit" class="btn btn-primary gumb float-end mt-3 mb-3" name="cf-submitted">Upit</button><br>
				</form>


			</div>
		</div>
	</div>
</section>
@endif
@endforeach
</section>
@endsection