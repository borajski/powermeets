@extends('front_layouts.front-master')
@section('content')
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12 bg-light pt-4 mt-2">
					<h1 class="display-3 text-center mt-3 mb-0">PowerNet</h1>
					<p class="text-muted h4 text-center mb-5">software za organizaciju i upravljanje powerlifting natjecanjima</p>		
					<div class="img-wrapper" style="background-image:url('{{asset('images/front/about.jpg')}}');">
					
				</div>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container py-5 bg-light">
		<div class="row">		
			<div class="col-md-8 offset-md-2 px-4 ">
				<div class="mb-4  text-center">					
						<h2>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
							Vestibulum tortor.</h2>				
				</div>
				<div class="mb-4">					
                <p>Powernet je jedinstvena web aplikacija za organizaciju sportskih natjecanja. PowerNet 1.0 razvijen je 2012. godine
    i od tada se je uspješno koristio i primjenjivao na svim powerlifting natjecanjima u Hrvatskoj, od domaćih do
    međunarodnih natjecanja.<br>
    PowerNet 2.0 je suvremena web aplikacija razvijena na Laravel tehnologiji. PowerNet omogućuje
    kreiranje powerlifting natjecanja te cjelokupno praćenje tijeka događaja od prijave natjecatelja do objave rezultata.
     <br><br>
    <b>Glavne značajke PowerNet 2.0:</b>
    <ul>
        <li>kreiranje sportskog natjecanja</li>
        <li>izrada prijavnice za natjecanje</li>
        <li>kontinuirano praćenje i uvid u tijek prijava</li>
        <li>objava liste prijavljenih na webu</li>
        <li>organizacija tijeka natjecanja</li>
        <li>vaganje natjecatelja</li>
        <li>izrada startnih lista i grupa za natjecanje</li>
        <li>ispis i/ili web objava startnih lista</li>
        <li>praćenje natjecanja i unos rezultata</li>
        <li>mogućnost online praÄ‡enja rezultata natjecanja</li>
        <li>kreiranje relativnih kategorija po želji</li>
        <li>obrada rezultata jednim klikom</li>
        <li>objava rezulata u realnom vremenu</li>
        <li>export rezultata u pdf ili csv formatu</li>
        <li>ispis rezultata (ispis certifikata ili diploma)</li>
        <li>arhiviranje rezultata</li>
        <li>cloud hosting ili vaš hosting</li>
    </ul></p>
    <p>Javite nam se za više informacije oko licence. <br>
        <a href="/contact">Kontakt obrazac</a></p>
    <h4><b><i>English translation with demo page coming soon!</i></b></h4>
				</div>
			</div>
			<!-- /col -->
		</div>
	</div>
</section>
@endsection