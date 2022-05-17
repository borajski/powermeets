@extends('front_layouts.front-master')
@section('content')
@php
function ispisiDatum($datum)
{
return Carbon\Carbon::parse($datum)->format('d.m.Y');
}
@endphp
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12 bg-light pt-4 mt-2">
					<h1 class="display-3 text-center mt-3 mb-0">{{$meet->naziv}}</h1>
					<p class="text-muted h4 text-center mb-5">{{$meet->opis}}</p>		
					<div class="img-wrapper" style="background-image:url('{{asset($meet->slika)}}');">
					
				</div>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container bg-light mb-4">
		<div class="row">		
			<div class="col-md-8 offset-md-2 px-4 mt-5">
			<div class="mb-4">	                    
            <h3 class="m-2"><b>Organizator:</b> <small>{{$meet->organizator}}</small></h3>
            <h3 class="m-2"><b>Tehnička pravila:</b> <small> {{$meet->federation->name}}</small></h3>
            <h3 class="m-2"><b>Mjesto:</b> <small> {{$meet->mjesto}}</small></h3>
            <h3 class="m-2"><b>Početak:</b> <small> {{ispisiDatum($meet->datump)}}</small></h3>
            <h3 class="m-2"><b>Završetak:</b> <small> {{ispisiDatum($meet->datumk)}}</small></h3>
            
            <h3 class="m-2"><b>Ostale informacije i obavijesti:</b></h3>
            <div class="m-2 mt-4">
                @php 
                if ($meet->gensetts->objave != null) {
                    try {
                        $quill = new \DBlackborough\Quill\Render($meet->gensetts->objave, 'HTML');
                        $result = $quill->render();
                    } catch (\Exception $e) {
                        echo $e->getMessage();
                    }
                    echo $result;
                }          
                @endphp
            </div>
            @if ($meet->gensetts->prijavnica == 'on')
            <p class="text-end m-4">
                <button class="btn btn-primary gumb" data-bs-toggle="collapse" href="#prijavnica" role="button"
                    aria-expanded="false" aria-controls="prijavnica" id="gumb-prijava">
                    {{ __('Apply form')}}
                </button>
            </p>
            <div class="collapse" id="prijavnica">
                <div class="card card-body mb-2 border-0">
                <form enctype="multipart/form-data" action="{{route('nominations.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="ime"><b>Ime/Name:</b></label>
                    <input type="text" class="form-control" name="ime" placeholder="Vaše ime" required />
                    <input type="hidden" class="form-control" name="meet_id" value="{{$meet->id}}" />
                </div>
                <div class="form-group">
                    <label for="prezime"><b>Prezime/Surname:</b></label>
                    <input type="text" class="form-control" name="prezime" placeholder="Vaše prezime" required />
                </div>
                <div class="form-group">
                    <label for="email"><b>Email:</b></label>
                    <input type="email" class="form-control" name="email" placeholder="Unesite vaš email" required />
                </div>
                <div class="form-group">
                    <label for="klub"><b>Klub/Team:</b></label>
                    <input type="klub" class="form-control" name="klub" placeholder="Unesite naziv vašeg tima"
                        required />
                </div>
                <div class="form-group">
                    <label for="drzava"><b>Država/Country:</b></label>
                    <select name="drzava" class="form-control" required>
                        <option value="" selected></option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Aland Islands">Aland Islands</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of
                            The
                        </option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernsey">Guernsey</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-bissau">Guinea-bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands
                        </option>
                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Isle of Man">Isle of Man</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's
                            Republic of
                        </option>
                        <option value="Korea, Republic of">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic
                        </option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macao">Macao</option>
                        <option value="North Macedonica">North Macedonia</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Helena">Saint Helena</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint Lucia">Saint Lucia</option>
                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines
                        </option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South
                            Sandwich Islands</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-leste">Timor-leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="United States Minor Outlying Islands">United States Minor Outlying
                            Islands
                        </option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Viet Nam">Viet Nam</option>
                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="datum-r"><b>Datum rođenja/Birth Date: </b></label>
                    <input class="form-control" type="date" name="datum_r" />
                </div>
                <div class="form-group">
                    <label for="spol"><b>Spol/Sex:</b></label>
                    <select class="form-select" id="spol" name="spol"
                        onchange="weightCat(this.value,'{{$meet->federation->name}}')" required>
                        <option selected></option>
                        <option value="M">Muški/Male</option>
                        <option value="Z">Ženski/Female</option>
                    </select>
                </div>
                <div class="form-group mt-4 mb-4">
                    <label for="discipline"><b>DISCIPLINE:</b></label>
                    <br>
                    @php
                    $discipline = explode(",",$meet->federation->disciplines);
                    $meet_discipline = explode(',',$meet->discipline);
                    $divizije = explode(",",$meet->federation->divisions);

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
                        <label for="dobna_kategorija">Dobna kategorija/Age category:</label>
                        <select class="form-select" name="dobna">
                            <option selected></option>
                            @php
                            $dobne = explode(",",$meet->federation->age_categories);
                            foreach ($dobne as $dob)
                            {
                            echo '<option value="'.$dob.'">'.$dob.'</option>';
                            }
                            @endphp
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kategorija">Težinska kategorija/Weight category:</label>
                        <select class="form-select" name="kategorija" id="kategorija">

                        </select>
                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary gumb">
                        {{ __('APPLY')}}
                        </button>
                    </div>
            </form>
                </div>
            </div>
            @endif
            @if ($meet->gensetts->nominacije == "on")	
            <h3 class="text-center mt-3 mb-5">{{ __('Nominations') }}</h3>
            @foreach ($division as $divizija)
            <h4 class="mt-2 mb-2"><strong> {{$divizija}}</strong></h4>
            @foreach ($discipline_meet as $single)
            @if ((substr($divizija,0,2)) == substr($single,0,2))
            @php 
            $disc = explode("-",$single);
            $disciplina = ucfirst($disc[1]);
            @endphp
            <button type="submit" class="btn btn-primary gumb m-1"
                onclick="getNominations('{{$meet->id.','.$single}}')">{{$disciplina}}</button>
            @endif
            @endforeach
            @endforeach
            <div class="table-responsive-sm mt-4 p-2">
                <div id="lista"></div>               
            </div>
        </div>
            @endif		
</div>
				</div>
			</div>
			<!-- /col -->
		</div>
	</div>
</section>


           
   
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
<script src="{{asset('js/back/nominations.js')}}" defer></script>
@endsection