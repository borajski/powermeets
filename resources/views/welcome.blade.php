@extends('front_layouts.front-master')
@section('content')
<section style="background-color:#00A2E2; height:100vh;">
	<div class="container-fluid overflow-hidden p-0">
		<div class="row g-0">
			<div class="col-md-6  my-auto text-center text-light" style="padding:10vw;">
				<div class="mb-3">
					<div editable="img-middle">
						<h1><strong>POWERNET</strong></h1>
						<p class="lead">Powernet is a software solution for organizing and conducting powerlifting competitions from the registration of competitors to the publication of results. </p>
					</div>
				</div>
				<div>
					<a class="btn btn-primary" href="#" role="button">Tell me more</a>
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
@endsection