@extends('front_layouts.front-master')
@section('content')
@php
function ispisiDatum($datum)
{
return Carbon\Carbon::parse($datum)->format('d.m.Y');
}
@endphp
<section>
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
<section class="text-light" style="background-color: #00517D;">
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
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="3em" height="3em" lc-helper="svg-icon" fill="currentColor">
						<path d="M48 32C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48H48zm0 32h106c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H38c-3.3 0-6-2.7-6-6V80c0-8.8 7.2-16 16-16zm426 96H38c-3.3 0-6-2.7-6-6v-36c0-3.3 2.7-6 6-6h138l30.2-45.3c1.1-1.7 3-2.7 5-2.7H464c8.8 0 16 7.2 16 16v74c0 3.3-2.7 6-6 6zM256 424c-66.2 0-120-53.8-120-120s53.8-120 120-120 120 53.8 120 120-53.8 120-120 120zm0-208c-48.5 0-88 39.5-88 88s39.5 88 88 88 88-39.5 88-88-39.5-88-88-88zm-48 104c-8.8 0-16-7.2-16-16 0-35.3 28.7-64 64-64 8.8 0 16 7.2 16 16s-7.2 16-16 16c-17.6 0-32 14.4-32 32 0 8.8-7.2 16-16 16z"></path>
					</svg>
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
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="3em" height="3em" lc-helper="svg-icon" fill="currentColor">
						<path d="M302.5 512c23.18 0 44.43-12.58 56-32.66C374.69 451.26 384 418.75 384 384c0-36.12-10.08-69.81-27.44-98.62L400 241.94l9.38 9.38c6.25 6.25 16.38 6.25 22.63 0l11.3-11.32c6.25-6.25 6.25-16.38 0-22.63l-52.69-52.69c-6.25-6.25-16.38-6.25-22.63 0l-11.31 11.31c-6.25 6.25-6.25 16.38 0 22.63l9.38 9.38-39.41 39.41c-11.56-11.37-24.53-21.33-38.65-29.51V63.74l15.97-.02c8.82-.01 15.97-7.16 15.98-15.98l.04-31.72C320 7.17 312.82-.01 303.97 0L80.03.26c-8.82.01-15.97 7.16-15.98 15.98l-.04 31.73c-.01 8.85 7.17 16.02 16.02 16.01L96 63.96v153.93C38.67 251.1 0 312.97 0 384c0 34.75 9.31 67.27 25.5 95.34C37.08 499.42 58.33 512 81.5 512h221zM120.06 259.43L144 245.56V63.91l96-.11v181.76l23.94 13.87c24.81 14.37 44.12 35.73 56.56 60.57h-257c12.45-24.84 31.75-46.2 56.56-60.57z"></path>
					</svg>
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
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 544 512" width="3em" height="3em" lc-helper="svg-icon" fill="currentColor">
						<path d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z"></path>
					</svg>
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
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="3em" height="3em" lc-helper="svg-icon" fill="currentColor">
						<path d="M624 416H381.54c-.74 19.81-14.71 32-32.74 32H288c-18.69 0-33.02-17.47-32.77-32H16c-8.8 0-16 7.2-16 16v16c0 35.2 28.8 64 64 64h512c35.2 0 64-28.8 64-64v-16c0-8.8-7.2-16-16-16zM576 48c0-26.4-21.6-48-48-48H112C85.6 0 64 21.6 64 48v336h512V48zm-64 272H128V64h384v256z"></path>
					</svg>
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
@endif
@endforeach
</section>
@endsection